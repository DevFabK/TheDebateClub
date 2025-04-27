$(document).ready(function () {
    $('#buscador').on('input', function () {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: '/buscar-temas', 
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    query: query
                },
                success: function (data) {
                    let html = '';

                    // Si hay resultados
                    if (data.length > 0) {
                        data.forEach(function (item) {
                            html += `<a class="tema-buscado" href="/tema/${item.id}">${item.titulo}</a>`;
                        });
                    } else {
                        html = '<div>No se encontraron resultados</div>';
                    }

                    if ($('#resultado').length === 0) {
                        $('.input-con-icono').after('<div id="resultado"></div>');
                    }

                    $('#resultado').html(html);
                }
            });
        } else {
            $('#resultado').remove();
        }
    });
});

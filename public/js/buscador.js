$(document).ready(function () {
    $('#buscador').on('input', function () {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: 'buscar-temas',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    query: query
                },
                success: function (data) {
                    let html = '';

                    if (data.temas.length > 0) {
                        html += '<div class="seccion-resultados"><h2>Temas</h2>';
                        data.temas.forEach(function (item) {
                            html += `<a class="resultado-enlace" href="/tema/${item.id}">${item.titulo}</a>`;
                        });
                        html += '</div>';
                    }

                    if (data.debates.length > 0) {
                        html += '<div class="seccion-resultados"><h2>Debates</h2>';
                        data.debates.forEach(function (item) {
                            html += `<a class="resultado-enlace" href="/debate/${item.id}">${item.titulo}</a>`;
                        });
                        html += '</div>';
                    }

                    if (html === '') {
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

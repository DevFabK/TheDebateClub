document.addEventListener("DOMContentLoaded", () => {
    fetch(`/obtenerDebatesDestacados`)
        .then(response => response.json())
        .then(data => {
            const tituloDestacados = document.querySelectorAll('.titulo-destacado');
            const descripcionDestacados = document.querySelectorAll('.descripcion-destacado');
            const contenidoArgumentos = document.querySelectorAll('.contenido-argumento');
            const posturaArgumentos = document.querySelectorAll('.postura-argumento');
            const puntuacionArgumentos = document.querySelectorAll('.puntuacion-argumento');

            if (
                tituloDestacados.length === data.length &&
                descripcionDestacados.length === data.length
            ) {
                data.forEach((item, index) => {
                    const debate = item.debate;
                    const argumento = item.argumentoDestacado;
                    const puntuacion = item.puntuacionTotal;

                    const tituloTexto = debate?.titulo;
                    tituloDestacados[index].innerHTML = tituloTexto ? marked.parse(tituloTexto) : "Sin título";

                    const descripcionTexto = debate?.descripcion;
                    descripcionDestacados[index].innerHTML = descripcionTexto ? marked.parse(descripcionTexto) : "Sin descripción";

 
                    if (argumento) {
                        const contenido = argumento.contenido;
                        const postura = argumento.postura;

                        if (contenidoArgumentos[index]) {
                            contenidoArgumentos[index].innerHTML = contenido ? marked.parse(contenido) : "<em>Sin contenido</em>";
                        }

                        if (posturaArgumentos[index]) {
                            posturaArgumentos[index].textContent = postura ?? "Sin postura";
                        }

                        if (puntuacionArgumentos[index]) {
                            puntuacionArgumentos[index].textContent = puntuacion ?? "0";
                        }
                    } 
                });
            } else {
                console.warn("Cantidad de elementos HTML no coincide con los datos.");
            }
        })
        .catch(error => {
            console.error("Error al obtener debates destacados:", error);
        });
});

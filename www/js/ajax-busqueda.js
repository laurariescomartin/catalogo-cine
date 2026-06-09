document.addEventListener("DOMContentLoaded", () => {
    const input = document.getElementById("busqueda");
    const resultados = document.getElementById("resultados");

    if (!input || !resultados) return;

    input.addEventListener("input", () => {
        const query = input.value.trim();

        if (query.length === 0) {
            resultados.innerHTML = "";
            return;
        }

        fetch("buscar_peliculas.php?q=" + encodeURIComponent(query))
            .then(res => res.json())
            .then(data => {
                resultados.innerHTML = "";
                if (data.length === 0) {
                    resultados.innerHTML = "<p>No se encontraron resultados.</p>";
                    return;
                }

                data.forEach(pelicula => {
                    const div = document.createElement("div");
                    const enlace = document.createElement("a");
                    enlace.href = `ver_pelicula.php?id=${pelicula.id}&q=${encodeURIComponent(query)}`;
                    enlace.textContent = pelicula.titulo;
                    div.appendChild(enlace);
                    resultados.appendChild(div);
                });
            })
            .catch(error => {
                console.error("Error al buscar:", error);
            });
    });
});

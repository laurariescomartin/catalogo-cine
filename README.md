# Plataforma de Gestión Cinematográfica Modular

Este proyecto consiste en una aplicación web dinámica para la gestión, moderación y visualización de un catálogo de cine. Fue desarrollada de forma incremental y evolutiva para la asignatura *Sistemas de Información Basados en Web* durante mi estancia de movilidad SICUE en la Universidad de Granada (Curso 2024-2025).

El objetivo principal fue construir una plataforma monolítica madura, segura y contenerizada, transitando desde interfaces estáticas hasta un sistema robusto con control de acceso basado en roles y comunicación asíncrona.

---

### 📈 Proceso de Desarrollo y Fases del Proyecto

La aplicación se estructuró en 5 fases de ingeniería, garantizando un crecimiento escalable del código:

#### Fase 1: Maquetación Estática y Diseño Adaptativo
Diseño de la interfaz base utilizando HTML5 semántico y layouts estructurados con **CSS3 Grid**. Se prescindió de frameworks externos (como Bootstrap) para garantizar un control total sobre las hojas de estilo y asegurar que la interfaz fuera completamente responsive ante diferentes resoluciones y niveles de zoom.

#### Fase 2: Interactividad en el Cliente (Frontend)
Desarrollo de scripts en JavaScript nativo (Vanilla JS) para gestionar el comportamiento dinámico de la interfaz, destacando el despliegue del panel lateral de comentarios. 

En esta fase se implementó un mecanismo de **sanitización en tiempo real** del lado del cliente. JavaScript lee en tiempo real lo que el usuario escribe en el cuadro de comentarios. Capturando el evento `keyup`, el sistema escanea el input y cambia las palabras no permitidas por asteriscos en la pantalla inmediatamente, antes de procesar el formulario:

```javascript
// JavaScript lee en tiempo real lo que el usuario escribe en el cuadro de comentarios
inputComentario.addEventListener('keyup', (e) => {
    // Guardamos el texto actual que hay escrito en la pantalla
    let texto = e.target.value;
    const palabrasProhibidas = ["palabra1", "palabra2"]; 
    
    // Si el usuario ha escrito una palabra de la lista, la cambiamos por asteriscos
    palabrasProhibidas.forEach(palabra => {
        let regex = new RegExp(palabra, "gi");
        texto = texto.replace(regex, "***");
    });
    
    // Actualizamos el cuadro de texto de la pantalla con los asteriscos ya puestos
    e.target.value = texto;
});

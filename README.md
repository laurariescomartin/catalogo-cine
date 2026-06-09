# Plataforma de Gestión Cinematográfica Modular (UGR)

Este proyecto consiste en una aplicación web dinámica para la gestión, moderación y visualización de un catálogo de cine. Fue desarrollada de forma incremental y evolutiva para la asignatura *Sistemas de Información Basados en Web* durante mi estancia de movilidad SICUE en la Universidad de Granada (Curso 2024-2025).

El objetivo principal fue construir una plataforma monolítica madura, segura y contenerizada, transitando desde interfaces estáticas hasta un sistema robusto con control de acceso basado en roles y comunicación asíncrona.

---

### Proceso de Desarrollo y Fases del Proyecto

La aplicación se estructuró en 5 fases de ingeniería, garantizando un crecimiento escalable del código:

#### Fase 1: Maquetación Estática y Diseño Adaptativo
Diseño de la interfaz base utilizando HTML5 semántico y layouts estructurados con CSS3 Grid. Se prescindió de frameworks externos (como Bootstrap) para garantizar un control total sobre las hojas de estilo y asegurar que la interfaz fuera completamente responsive ante diferentes resoluciones y niveles de zoom.

#### Fase 2: Interactividad en el Cliente (Frontend)
Desarrollo de scripts en JavaScript nativo (Vanilla JS) para gestionar el comportamiento dinámico de la interfaz, destacando el despliegue del panel lateral de comentarios. 

En esta fase se implementó un mecanismo de sanitización en tiempo real del lado del cliente. JavaScript lee en tiempo real lo que el usuario escribe en el cuadro de comentarios. Capturando el evento 'keyup', el sistema escanea el input y cambia las palabras no permitidas por asteriscos en la pantalla inmediatamente, antes de procesar el formulario para evitar contenido ofensivo.

#### Fase 3: Arquitectura de Servidor e Infraestructura (Docker)
Aquí el proyecto deja de ser una página plana y pasa a tener un "cerebro" en el servidor usando PHP. 
* Vistas ordenadas: Se instaló el motor de plantillas Twig para que el código PHP no estuviera mezclado con el HTML. Las plantillas de las páginas se heredan de forma limpia.
* Uso de Contenedores: Para evitar que el programa fallara por culpa de los puertos de la máquina o configuraciones locales, todo se metió en Docker (con un archivo docker-compose.yml), separando por completo el servidor Apache de la base de datos MySQL.

#### Fase 4: Panel de Control y Permisos por Roles (RBAC)
Creamos la base de datos de verdad y un Panel de Control donde los usuarios interactúan según lo que tengan permitido. El sistema sabe qué puedes hacer mirando tu "rol" en la base de datos (anónimo, registrado, moderador, gestor o superusuario).

Antes de dejar que alguien entre a una zona prohibida (como editar una película o cambiar comentarios), el servidor comprueba la sesión del usuario de forma estricta en el backend antes de renderizar la página.

#### Fase 5: Optimización Asíncrona (Buscador AJAX)
Implementación de un motor de búsqueda dinámica "estilo Google" mediante peticiones asíncronas (AJAX) controladas por el archivo ajax-busqueda.js. El cliente se comunica con el servidor en segundo plano sin recargar la página, intercambiando datos en formato JSON o XML.

Por requisitos de negocio y seguridad, la consulta SQL resultante se filtra dinámicamente en el backend dependiendo de la sesión activa: los usuarios comunes solo obtienen resultados de películas con el flag 'publicado = 1', mientras que el rol 'gestor' puede buscar de la misma forma entre todo el catálogo, incluyendo borradores o películas sin publicar.

---

### Buenas Prácticas de Ciberseguridad Aplicadas

Orientando el desarrollo hacia un enfoque seguro, la aplicación cuenta con las siguientes capas de protección nativas:
1. Mitigación de Vulnerabilidades XSS (Cross-Site Scripting): Al renderizar con Twig, se fuerza el auto-escapado estricto de todas las variables introducidas por los usuarios en los formularios públicos (como los comentarios).
2. Cifrado de Credenciales: Queda prohibido el almacenamiento de contraseñas en texto plano. El backend procesa las claves mediante el algoritmo de hashing criptográfico bcrypt antes de insertarlas en la tabla Usuario.
3. Seguridad en la Capa de Datos: Validación exhaustiva de parámetros GET y POST en el servidor de forma independiente a las restricciones de JavaScript. Uso de interfaces orientadas a objetos y consultas parametrizadas para neutralizar ataques de Inyección SQL.

---

### Stack Tecnológico

* Backend: PHP nativo (Gestión segura de sesiones y validación de inputs).
* Frontend: JavaScript nativo (Vanilla JS), AJAX (Peticiones asíncronas), Twig Template Engine, CSS3.
* Persistencia: MySQL (Triggers, restricciones de integridad referencial, hashes criptográficos).
* Entorno y DevOps: Docker, Docker Compose, Linux Bash scripting (dev_build_container.sh).

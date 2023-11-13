Integrantes: Victoria Cepeda (victoriacepeda.m@gmail.com) 
             Sofia Micaela Cuartas (cuartassofi@gmail.com)

Endpoints:

🏨Listado de todas las habitaciones: Permite obtener un listado de todas las habitaciones y sus características en formato de objeto JSON. 
HTTP METHOD: GET.

• Ejemplo para obtener todas las habitaciones: http://localhost/API-Rest/api/rooms

• Ejemplo para obtener las habitaciones dado un campo de la tabla y un tipo de orden: http://localhost/API-Rest/api/rooms/?sort_by=precio&order=desc

• Ejemplo 2 para obtener las habitaciones dado un campo de la tabla y un tipo de orden: http://localhost/API-Rest/api/rooms/?sort_by=id&order=asc

• Ejemplo para obtener todas las habitaciones filtrando por precio: http://localhost/API-Rest/api/room?filter=precio&type=45

• Ejemplo para obtener la primera página de habitaciones con un límite de 4 habitaciones por página: http://localhost/API-Rest/api/rooms?page=1&per_page=4

🏨Listado de una habitacion en particular (por id): se ingresa el id de la habitacion de la cual se quiere ver su información y se lista esa en particular. 
HTTP METHOD: GET 
• Ejemplo: http://localhost/API-Rest/api/rooms/7

Aclaración: Para utilizar las funciones agregar y modificar una habitacion, primero se debe  el utilizar el endpoint http://localhost/API-Rest/api/user/token .El mismo permite obtener el token que autoriza a realizar las funciones nombradas anteriormente (nombre: webadmin y contraseña: admin).
HTTP METHOD: GET. Se debe ir a Authorization y completar los requerimientos en Basic Auth.

🏨Agregar una nueva habitacion: Se completan todos los campos requeridos en la sección 'body' y se agrega una habitacion.
• Ejemplo: http://localhost/API-Rest/api/rooms 
METHOD: POST En el body en el apartado raw se incluiría un fragmento ejemplar similar al siguiente: { "tamaño": "septima superior", "descripcion": "Las habitaciones cuentan con ventilador de techo, LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.", "imagen": "images/habitacion_doble.jpg", "precio": 45 } 
Ejemplo de lo que va en Authorization (Bearer token):eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6Miwibm9tYnJlIjoid2ViYWRtaW4iLCJhcGVsbGlkbyI6IiIsImRuaSI6MCwiZW1haWwiOiIiLCJjb250cmFzZVx1MDBmMWEiOiIkMnkkMTAkUkdiSGJrYWhtbENnLnpEWUFLMnpzZXlRYlA4TFNheTNWRkJoMjBtRmJ3SXBVb2dySER1MFMiLCJhZG1pbiI6MX0.g31zTd6GqRXyPnw0HE6oV0jWSHOg-yeZkDLzm0JnMnI

🏨Modificar una habitacion: Permite modificar una habitacion dado su id y completando los campos requeridos.  
• Ejemplo: http://localhost/API-Rest/api/rooms/7 
HTTP METHOD: PUT En el body en el apartado raw se incluiría un fragmento ejemplar similar al siguiente: { "tamaño": "triple superior", "descripcion": "Las habitaciones cuentan con ventilador de techo, LED 32, cajas de seguridad digitales, secador de cabello, sommiers, calefacción central, acceso a internet wi-fi, room service las 24 hs, servicio de lavandería, servicio de despertador, baño privado (con ducha), servicio de conserje, amenities shampoo y jabón, desayuno para celiacos incluido en la tarifa, información turística, sillas de bebé, servicio de ropa blanca, ropa de cama toallas y toallones.", "imagen": "images/habitacion_doble.jpg", "precio": 45 } 
Ejemplo de lo que va en Authorization (Bearer token):eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6Miwibm9tYnJlIjoid2ViYWRtaW4iLCJhcGVsbGlkbyI6IiIsImRuaSI6MCwiZW1haWwiOiIiLCJjb250cmFzZVx1MDBmMWEiOiIkMnkkMTAkUkdiSGJrYWhtbENnLnpEWUFLMnpzZXlRYlA4TFNheTNWRkJoMjBtRmJ3SXBVb2dySER1MFMiLCJhZG1pbiI6MX0.g31zTd6GqRXyPnw0HE6oV0jWSHOg-yeZkDLzm0JnMnI
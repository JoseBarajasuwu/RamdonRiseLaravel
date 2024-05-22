<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Recuadro con Inputs y Botón</title>
    <!-- Incluir Bootstrap CSS desde un CDN -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Personaliza el estilo del recuadro */
        .recuadro {
            background-color: #f0f0f0;
            border: 2px solid #ccc;
            padding: 20px;
            max-width: 400px; /* Establece el ancho máximo */
            margin: 0 auto; /* Centra horizontalmente */
        }

        /* Establece el estilo del contenedor del logo */
        .logo-container {
            text-align: center; /* Centra el contenido */
            padding: 20px; /* Aplica el padding deseado */
            display: flex; /* Utiliza flexbox */
            justify-content: center; /* Centra horizontalmente */
        }

        /* Establece el tamaño de la imagen */
        .logo-img {
            width: 20%; /* Cambia el tamaño según tus necesidades */
        }
    </style> --}}
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <!-- Contenedor del logo con padding -->
                <div class="logo-container">
                    <!-- Imagen centrada -->
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTYfkmUBxwXXdFKEvQeQjKbH2P1Ohc5ClXwSD83G7mL6w&s" class="logo-img">
                </div>

            <!-- Recuadro central -->
            <div class="recuadro">
                <form id="loginForm">
                    @csrf <!-- Agrega el token CSRF -->
                    <!-- Inputs -->
                    <div class="mb-3">
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario">
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control" id="contraseña" name="contraseña" placeholder="Contraseña">
                    </div>
                    <!-- Botón de inicio de sesión -->
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </form>
            </div>

            </div>
        </div>
    </div>

   {{-- <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente

            // Obtiene los valores de los campos del formulario
            var usuario = document.getElementById('usuario').value;
            var contraseña = document.getElementById('contraseña').value;

            // Construye los datos a enviar
            var data = {
                usuario: usuario,
                contraseña: contraseña
            };

            // Realiza la solicitud POST a la API utilizando fetch
            fetch('api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => {
                // Verifica si la solicitud fue exitosa
                if (response.ok) {
                    // Maneja la respuesta como desees
                    console.log('Solicitud exitosa');
                } else {
                    // Maneja el caso de error
                    console.error('Error al enviar la solicitud');
                }
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
            });
        });
    </script>  --}}
</body>
</html>


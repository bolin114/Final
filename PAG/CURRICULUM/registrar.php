<?php
include 'cn.php';

$nombre = $_POST["nombre"]; //Se jala lo del campo que tiene  nombre en el index
$apellidos = $_POST["apellidos"]; 
$correo = $_POST["correo"]; 
$usuario = $_POST["usuario"]; 
$clave = $_POST["clave"]; 
$telefono = $_POST["telefono"]; 
$comentario = $_POST["comentario"]; 

//Consulta para insertar datos desde el formulario hacia la base de datos
$insertar = "INSERT INTO usuario(nombre, apellidos, correo, usuario, clave, telefono, comentario)
 VALUES ('$nombre','$apellidos','$correo','$usuario','$clave','$telefono','$comentario')";//Las variables que estan aqui se mandan a la base de datos

//Verifica usuario y correo,  query es para consultar, referencia a un campo de la base va sin comillas, y si es dentrod e la base es entre ''
$verificar_usuario = mysqli_query($conexion,"SELECT * FROM usuario WHERE usuario = '$usuario'");

//echo 'El usuario ya existe';
if(mysqli_num_rows($verificar_usuario) > 0)
{
    echo '<script languaje="javascript">alert("El usuario ya existe");
    window.history.go(-1);
    </script>';
    exit; //Para que no se guarde los datos
}

$verificar_correo = mysqli_query($conexion,"SELECT * FROM usuario WHERE correo = '$correo'");

//es un script de lenguaje java script, alert es una instruccion de javascript.
//lo que hace windows.history.go(-1); regresa a una pestaña atras
if(mysqli_num_rows($verificar_correo) > 0)
{
    echo '<script languaje="javascript">alert("El correo ya existe");
    window.history.go(-1);
    </script>';
    exit; //Para que no se guarde los datos
}
//SI ESTA VACIO
if(isset($_POST['boton']))
{
    if(empty($nombre)) //Si esta vacia 
    {
        // echo"<p class='error'>Agrega tu nombre</p>";
        echo'<script languaje="javascript">alert("Agrega tu NOMBRE");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(empty($apellidos)) //Si esta vacia 
    {
        // echo"<p class='error'>Agrega tu nombre</p>";
        echo'<script languaje="javascript">alert("Agrega tu APELLIDO");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(empty($correo)) //Si esta vacia 
    {
        // echo"<p class='error'>Agrega tu nombre</p>";
        echo'<script languaje="javascript">alert("Agrega tu CORREO");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(empty($usuario)) //Si esta vacia 
    {
        // echo"<p class='error'>Agrega tu nombre</p>";
        echo'<script languaje="javascript">alert("Agrega tu USUARIO");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(empty($clave)) //Si esta vacia 
    {
        // echo"<p class='error'>Agrega tu nombre</p>";
        echo'<script languaje="javascript">alert("Agrega tu CLAVE");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(empty($telefono)) //Si esta vacia 
    {
        // echo"<p class='error'>Agrega tu nombre</p>";
        echo'<script languaje="javascript">alert("Agrega tu TELEFONO");
        window.history.go(-1);
        </script>';
        exit;
    }
} //termnar todas las validaciones
//validacion de la longitud de los campos
if(isset($_POST['boton']))//El boton activa todos los elementos, asi que se vuelve a valdiar.
{
    if(strlen($nombre) > 100)
    {
        echo'<script languaje="javascript">alert("El NOMBRE es demasiado largo");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(strlen($apellidos) > 100)
    {
        echo'<script languaje="javascript">alert("El APELLIDO es demasiado largo");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(strlen($correo) > 100)
    {
        echo'<script languaje="javascript">alert("El CORREO es demasiado largo");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(strlen($usuario) > 20)
    {
        echo'<script languaje="javascript">alert("El USUARIO es demasiado largo");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(strlen($clave) > 10)
    {
        echo'<script languaje="javascript">alert("La CLAVE es demasiado larga");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(strlen($telefono) > 10)
    {
        echo'<script languaje="javascript">alert("El TELEFONO es demasiado largo");
        window.history.go(-1);
        </script>';
        exit;
    }

    if(strlen($comentario) > 300)
    {
        echo'<script languaje="javascript">alert("El COMENTARIO es demasiado largo");
        window.history.go(-1);
        </script>';
        exit;
    }
}//Termina de validar la longitud

$resultado = mysqli_query($conexion,$insertar);

if($resultado)
{
    #echo 'Usuario registrado exitosamente';
    echo '<script languaje="javascript">alert("Usuario registrado exitosamente");
    window.history.go(-1);
    </script>';
}
else if(!$resultado)
{
    #echo 'Error al registrar el usuario';
    echo '<script languaje="javascript">alert("Error al registrar el usuario");
    window.history.go(-1);
    </script>';
}

 //Cerrar conexión a la base de datos
 mysqli_close($conexion);
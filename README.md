# Monitoreo-de-datos mediante js, php y Ajax
 Monitoreo de datos Ajax en aplicacion web

Lenguajes: PHP, JS.

Aplicacion web para monitorear parametros de cualquier dispositivo que pueda crear un POST a una ip. 
Utiliza framework https://www.canvas.com/

Al grafico que se muestra en pantalla es:

Secuencia:

1) El mensaje POST escribe los nuevos datos en la base de datos
2) Se imprimen valores de base de datos en formato JSON.
3) Variable de javascript rescata estos valores mediante la variable dataPoints1 y dataPoints2 (opcional)
3) Para actualizar el grafico simplemente se atrasa la funcion update por un segundo mediante el codigo:

setTimeout(function(){UpdateCharts()},1000);

Se tienen funciones para borrar, resetear y grabar los valores bajo variables. Los nombres de estos valores de actualizan mediante un requerimiento Ajax (ver TablasInfo.php)

Listo¡

https://github.com/Alexanderh1988/Monitoreo-de-datos-Ajax/blob/main/Grafico%20sonido.png?raw=true

Dudas o consultas: 
info@hstech.cl
alex.utfsm@gmail.com

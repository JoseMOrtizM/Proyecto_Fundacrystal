<?php
//conexion
require ("conexion.php");
if(!isset($_POST['art_titulo'])){}else{
	$titulo_articulo=$_POST['art_titulo'];
	//SUMANDO UN ME_GUSTA AL ARTICULO
	$consulta="UPDATE `datos_articulos` SET ME_GUSTA=ME_GUSTA+1, VISITAS=VISITAS+1 WHERE ART_TITULO='$titulo_articulo'";
	$resultado=mysqli_query($conexion,$consulta);
}
//SUMANDO UNA VISITA AL SITIO
$consulta="UPDATE `datos_visitas` SET VISITAS=VISITAS+1 WHERE DESCRIPCION='TOTAL'";
$resultado=mysqli_query($conexion,$consulta);
//FECHA Y HORA PARA LA QUE SE EJECUTO LA VISITA
$fecha_ahora_ano=date("Y"); 
$fecha_ahora_mes=date("m");
//SUMANDO UNA VISITA AL MES ACTUAL
$consulta="UPDATE `datos_visitas` SET VISITAS=VISITAS+1 WHERE DESCRIPCION='$fecha_ahora_ano-$fecha_ahora_mes'";
$resultado=mysqli_query($conexion,$consulta);
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
//META CANONICAL PARA INDEX
echo "<link rel='canonical' href='http://www.fundacrystal.tk/index.php' />";
// TIPO DE IDIOMA Y TIPO DE DOCUMENTO
echo "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />";
// META DESCRIPCION
echo "<meta name='description' content='Orientación a familiares y personas con TEA o Autismo. La mejor información; tratamientos, terapias y dietas, desarrollada por expertos de todo el mundo' />";
// META ROBOTS PARA PÁGINA INDEX Y BUSQUEDA LIKE O VISIBLE AL BUSCADOR
echo "<meta name='robots' content='index, follow'>";
// META ROBOTS PARA PÁGINAS INTERNAS INVISIBLES AL BUSCADOR PERO RASTREABLES
//echo "<meta name='robots' content='noindex, follow'>";
// META KEYS WORDS SACADAS DE LA LISTA DE CATEGORIAS DE LA BD
echo "<meta name='keywords' content='Fundación Crystal, FundaCrystal";
  //OBTENIENDO CATEGORIAS DE LA BD
  $consulta="SELECT TAGS FROM `DATOS_TAGS` GROUP BY TAGS ORDER BY TAGS";
  $resultado=mysqli_query($conexion,$consulta);
  $cta_categoria=0;
  while(($fila=mysqli_fetch_array($resultado))==true){
    $tags[$cta_categoria]=$fila['TAGS'];
    $cta_categoria=$cta_categoria+1;
  }
  //PONIENDO EL CONTADOR EN SU LUGAR
  $cta_categoria=$cta_categoria-1;
  //IMPRIMIENDO CATEGORIAS
  $i=0;
  while($i<=$cta_categoria){
    echo ", $tags[$i]";
    $i=$i+1;
  }
  $cantidad_de_palabras_clave=$i;
echo "'/>";
echo "<meta property='og:title' content='¡Ayúdanos a conseguir una mejor comprensión del autismo en Venezuela! - FundaCrystal'/>";
//Compatibilidad con Internet Explorer
echo "<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'>";
//Schema.org para Google
echo "<meta itemprop='name' content='FundaCrystal'>";
echo "<meta itemprop='description' content='Orientación a familiares y personas con TEA o Autismo. La mejor información; tratamientos, terapias y dietas, desarrollada por expertos de todo el mundo'>"; 
echo "<meta itemprop='image' content='http://fundacrystal.tk/FUNDACRYSTAL/IMAGENES/LOGO01.jpg'>";// OJO: HAY QUE COLOCAR ESTE LOGO EN LA RAIZ DEL HOSTING
?>
<title>Fundación Crystal - Inicio</title>
<link rel="stylesheet" href="Estilo_Principal.css"/>
<?php
//header
require ("efecto_entrada.php");
?>
</head>
<body>
<?php
//header
require ("header.php");
//aside
require ("aside.php");
?>
<section>
<article style='background-color:#fff; margin-top:15px; border-radius:30px 0px 20px 0px;'>
<div class='articulo_titulo' style='color:#000; border-radius:20px 0px 0px 0px;'><h2 style='margin-top:0px; text-align:center;'>¿Que es el Autismo?</h2></div>
<figure class='div-img1 hidden' style='float:right; width:49%; margin:1%;'><img class='img1' src='IMAGENES/logo_autismo17.jpg'/></figure>
<p>El autismo es un trastorno neurológico complejo que generalmente dura toda la vida. Es parte de un grupo de trastornos conocidos como trastornos del espectro autista (ASD por sus siglas en inglés). Actualmente se diagnostica con autismo a 1 de cada 68 individuos y a 1 de cada 42 niños varones, haciéndolo más común que los casos de cáncer, diabetes y SIDA pediátricos combinados. Se presenta en cualquier grupo racial, étnico y social, y es cuatro veces más frecuente en los niños que en las niñas. El autismo daña la capacidad de una persona para comunicarse y relacionarse con otros. También, está asociado con rutinas y comportamientos repetitivos, tales como arreglar objetos obsesivamente o seguir rutinas muy específicas. Los síntomas pueden oscilar desde leves hasta muy severos.</p>
<p>Los trastornos del espectro autista se pueden diagnosticar formalmente a la edad de 3 años, aunque nuevas investigaciones están retrocediendo la edad de diagnóstico a 6 meses. Normalmente son los padres quienes primero notan comportamientos poco comunes en su hijo o la incapacidad para alcanzar adecuadamente los hitos del desarrollo infantil. Algunos padres explican que su hijo parecía diferente desde su nacimiento y otros, que iba desarrollándose normalmente y luego perdía aptitudes. Puede que inicialmente los pediatras descarten las señales del autismo pensando que el niño podrá alcanzar el nivel deseado y le aconsejan a los padres que esperen y vean como se desarrolla. Nuevas investigaciones muestran que cuando los padres sospechan que hay algo mal con su hijo, generalmente están en lo correcto. Si tienes inquietudes acerca del desarrollo de tu hijo, no esperes y habla con su pedíatra para que sea evaluado.</p>
<p>Si a tu niño lo han diagnosticado con autismo, una intervención temprana es crítica para que pueda beneficiarse al máximo de todas las terapias existentes. Aunque para los padres puede ser difícil etiquetar a un pequeño como “autista”, entre más pronto se haga el diagnóstico cuanto antes se podrá actuar. Actualmente no existen medios efectivos para prevenir el autismo, ni tratamientos totalmente eficaces o cura. Sin embargo, las investigaciones indican que una intervención temprana en un entorno educativo apropiado, por lo menos por dos años durante la etapa preescolar, puede tener mejoras significativas para muchos niños pequeños con trastornos del espectro autista. Tan pronto como se diagnostique el autismo, la intervención temprana debe comenzar con programas eficaces, enfocados en el desarrollo de habilidades de comunicación, socialización y cognoscitivas.</p>
<p><a href="https://www.autismspeaks.org/qu%C3%A9-es-el-autismo">https://www.autismspeaks.org</a></p>
</article>
<article style='background-color:#fff; margin-top:15px; border-radius:30px 0px 20px 0px;'>
<div class='articulo_titulo' style='color:#000; border-radius:20px 0px 0px 0px;'><h2 style='margin-top:0px; text-align:center;'>Señales de Alerta del Autismo</h2></div>
<figure class='div-img1 hidden' style='float:left; width:40%; margin:1%;'><img class='img1' src='IMAGENES/logo_autismo15.jpg'/></figure>
<p>Las siguientes señales de alerta pueden indicar que su hijo está en riesgo de un trastorno del espectro autista. Si su hijo presenta alguno de los siguientes, por favor no demore en consultar con su pediatra o médico de familia. Para un diagnóstico para su hijo, debe de ser referido a un especialista para una evaluación más completa.</p>
<ul>
<li>1- No tiene sonrisas grandes u otras expresiones cálidas y de alegría a los 6 meses o a partir de entonces.</li>
<li>2- No comparte sonidos, sonrisas y otras expresiones faciales repetidamente a los 9 meses o a partir de entonces.</li>
<li>3- No balbucea a los 12 meses.</li>
<li>4- No hace gestos tales como señalar, mostrar, alcanzar o saludar a los 12 meses.</li>
<li>5- No dice palabras a los 16 meses.</li>
<li>6- No formula frases de dos palabras con significado (sin imitar o repetir) a los 24 meses.</li>
<li>7- Cualquier pérdida del habla, balbuceo o habilidades sociales a cualquier edad.</li>
</ul>
<p>Tomado de <a href="https://www.autismspeaks.org/qu%C3%A9-es-el-autismo/aprenda-las-se%C3%B1ales-del-autismo">https://www.autismspeaks.org</a></p>
</article>
<article style='background-color:#fff; margin-top:15px; border-radius:30px 0px 20px 0px;'>
<div class='articulo_titulo' style='color:#000; border-radius:20px 0px 0px 0px;'><h2 style='margin-top:0px; text-align:center;'>El Autismo No es una enfermedad</h2></div>
<figure class='div-img1 hidden' style='float:right; width:49%; margin:1%;'><img class='img1' src='IMAGENES/logo_autismo19.jpg'/></figure>
<p>Hay quien dice que es por un aumento de la testosterona durante el embarazo y que por ello hay mayoría de hombres con autismo que mujeres y por ello, los cerebros son algo así como un cerebro masculinizado al extremo, con un exceso de comprensión en tres dimensiones (lo que hace que a los hombres se les dé mejor la electrónica, la arquitectura o la informática) y un defecto en la empatía y el lenguaje (lo que sugiere que las mujeres sean más aptas para trabajo social o psicología). No obstante, recientes investigaciones empiezan a apuntar que quizá, en lo referido al diagnóstico de mujeres algo esté equivocado, y posiblemente existan más de las que pensábamos anteriormente.</p>
<p>Otras personas explican que tiene que ver con un déficit de la hormona oxitocina de la neurohipófisis, que aparte de provocar las contracciones en el parto y eyectar la leche de la madre al lactante, es conocida como “la hormona del amor” que genera empatía en nuestros amigos y malestar en nuestros desconocidos o enemigos.</p>
<p>Lo que está claro es que el autismo, y os lo puedo decir como biólogo, no aparece así como así en una persona, el autismo está en los genes, ¿en qué genes?, no puedo decirlo porqué lo desconozco ya que la genética es un campo muy complicado, el Proyecto Genoma Humano ha estimado que los seres humanos tienen entre 20.000 y 25.000 genes, y luego mucho del conocido “DNA basura” que se ha demostrado que no es tan basura ya que  interfiere en la regulación de los genes como los miRNA.</p>
<p>Además, hemos de tener en cuenta que la cosa se complica con la epigenética, que es rizar el rizo, aquella ciencia que estudia los procesos moleculares de porque unos genes se expresan a proteínas y otros no.</p>
<p>Con todo esto quiero decir que es difícil abarcar cuales son los genes del autismo y de hacer un posible diagnóstico prenatal.</p>
<p>Al fin y al cabo, hay muchísimos genes que desconocemos su función y un gen puede codificar varias proteínas, y las proteínas hacen interacción entre sí, con lo cual podemos decir que el autismo es un elenco de factores muy difícil de descifrar.</p>
<p>Por ello, cuando me preguntan «quién soy» puedo decir que soy muchas cosas, pero una de las condiciones que tengo es estar dentro del espectro del autismo, en otros países -donde hablar de neurodivergencia está más socialmente aceptado como USA o UK- se emplea la definición condición del espectro del autismo (CEA) en vez de trastornos del espectro del autismo (TEA).</p>
<p>En el fondo con todo esto, lo que pretendo decir es que una condición no es una enfermedad, trato de explicar que no hay un agente etiológico que desencadene el autismo, como no lo hay para tener los ojos azules, o la estatura.</p>
<p>Realmente el autismo es una alteración de carácter neurobiológico que genera una construcción inesperada de determinadas áreas del cerebro, y en función del tamaño de las áreas afectadas la severidad es mayor o menor, cosa que no hace que sea algo no natural, sino algo sencillamente diferente, una condición neural distinta que encaja en lo que englobamos los TEActivistas como neurodiversidad.</p>
<p>Todos sabemos que la diferencia no implica enfermedad, por ejemplo, la trisomía del par 21, el síndrome de Down tampoco es una enfermedad, es un síndrome como su propio nombre indica, que se suele acompañar de enfermedades o malformaciones, cardiopatías, por ejemplo, por ello -en un pasado cercano- muchos morían jóvenes. Sin embargo, hoy en día, y gracias a los avances médicos, muchos de los aspectos de salud que afectaban a la esperanza de vida de las personas con Down son tratables en base a fármacos o con intervención quirúrgica.</p>
<p>Es decir, son tratadas las comorbilidades o las coocurrencias, no los síndromes de base.</p>
<p>Los medicamentos que se suelen prescribir a personas con autismo habitualmente están destinadas a la población general para tratar aspectos generales relacionados con la salud mental, las formas farmacéuticas contienen fármacos o principios activos de tres tipos.</p>
<p>Las benzodiacepinas: Como el loracepam, diacepam o el Valium, que sirven para reducir la ansiedad, tomadas también por los neurotípicos.</p>
<p>Los antidepresivos, encaminados a captar serotonina y reducir la depresión como la velafaxina, la sertralina o el dumirox, también tomadas por los neurotípicos.</p>
<p>Los mal llamados “antipsicóticos” como el risperdal, abilify o zyprexa encaminados a reducir el malestar psicológico, no la psicosis, y también en muchísimos casos tomados por muchos neurotípicos y en muchos casos por personas con esquizofrenia.</p>
<p>Hasta aquí podemos observar que la salud de las personas con autismo no es diferente a la de los neurotípicos ya que no requiere de medicación diferente. Vemos que se usan para tratar aspectos co-ocurrentes, como depresión o ansiedad, que son también comunes en la población general. Factores que tienen en muchos casos un origen ambiental, del entorno vital de la persona.</p>
<p>Podemos citar entonces que causas puede mejorar y empeorar el autismo, (cosas que pueden ocurrir con otras personas neurotípicas a su vez)</p>
<ul>
<li>- El nivel socioeconómico de su entorno.</li>
<li>- Su entorno afectivo.</li>
<li>- Los correctos hábitos de salud, higiene, nutrición.</li>
</ul>
<p>Si estos factores no son adecuados las personas con autismo podemos empeorar nuestras coocurrencias, no por tener autismo en sí mismo, sino por encontrar un mundo hostil, por una mala salud o por no tener los apoyos adecuados que nos ayuden a abordar un mundo neurotípico con leyes y normas diferentes a nuestra condición de nacimiento.</p>
<p>Los síntomas de esta falta de salud derivadas de la falta de adaptación al mundo pueden ser muy variadas y se pueden tornar sobre todo en una falta de comprensión y aceptación de los padres, una falta de comprensión en los profesionales sanitarios que sobremediquen a la persona con autismo o mediquen incorrectamente haciendo más pronunciados sus síntomas, como las estereotipias, las autolesiones o la incapacidad de comunicarse con el entorno.</p>
<p>El autismo en sí mismo no es un mal, el mal es el que ven las personas neurotípicas en nosotros y al intentar cambiar nuestra naturaleza generan le enfermedad.</p>
<p>Pienses ustedes, lectores, que las personas con autismo, estamos sometidos día y noche y todos los días de nuestra vida a un mundo de estímulos y agresiones que nuestro diferente cerebro no puede procesar.</p>
<p>Pero tener un cerebro diferente no es falta de salud, es condición de neurodivergencia.</p>
<figure class='div-img1 hidden' style='float:left; width:41%; margin:1%;'><img class='img1' src='IMAGENES/logo_autismo10.jpg'/></figure>
<p>Yo, por ejemplo, durante muchos años me he medicado por la ansiedad y la depresión, pero ninguna de las dos cosas me las ha provocado el autismo; ambas las tengo por el bullying, los insultos y agresiones recibidos durante muchos años y por el ghosting y la ignorancia e intolerancia de muchísimas personas neurotípicas que han dejado una dolorosa huella en mí. Quizá, algún lector, pueda intentar afirmar que sufrí esos cuadros debido a que, por mi autismo, mi ingenuidad social me colocaba en una posición más vulnerable. Bien, pues si ser más ingenuo, o no tener actitudes depredatorias hacia los demás es algo malo, quizá los que realmente están enfermos sean los demás, y no quienes tenemos autismo.</p>
<p>Los medicamentos, los nutrientes, la calidad socio económica, dónde y cuándo viva, el estado afectivo social, …, pueden modificar el bienestar de salud de la persona, pero NO cambiar su condición, la condición autista es para toda la vida y debe de ser aceptada tanto por la propia persona como por los familiares y resto de individuos que lo rodean.</p>
<p>Respeto que merecemos todos y todas independientemente de la condición que tengamos.</p>
<p>Esto no quiere decir que no haya medicamentos que mejoren la sintomatología asociada a la presión social que recibirá a lo largo de su vida (Exactamente igual que les sucede a los neurotípicos), ni que no sean necesario, pero no podemos pretender “curarles” de lo que son, (de lo que somos) ¡Por favor, no me curen mi bondad!</p>
<p>Tampoco voy a negar que haya nutrientes más saludables que otros, o que haya dietas mejores que otras, siempre la nutrición se relaciona con la salud y puede ayudar a mejorar síntomas, pero no hay “dietas milagro” que curen el autismo.</p>
<p>Lo mismo podemos decir para el gluten y la caseína, la primera un conjunto de dos proteínas encontradas en ciertos cereales como el trigo y la cebada y la segunda una proteína en la leche; siempre es bueno saber si estos nutrientes pueden afectar de mala manera a la persona con autismo y empeorar su sintomatología o sin son intolerantes a ella (como a la lactosa), pero ello no nos debe hacer perder la vista de que una dieta equilibrada puede mejorar la salud, pero no curar el autismo.</p>
<p>Otro tema es el de las vacunas, éstas, como medicamentos preventivos, contienen proteínas de virus o bacterias o muestras de estos mismos de manera atenuada para que el sistema inmunológico pueda generar anticuerpos contra estos e inmunizar el organismo del paciente.</p>
<p>Cierto es que la industria farmacéutica ha abusado en ocasiones de las vacunas como de otros medicamentos, cierto es que ha habido gente que se ha quedado en silla de ruedas y con las capacidad cognitivas afectadas de por vida, pero estos casos son mínimos, de uno entre un millón produce una alteración grave de salud, con lo cual quiero decir que promover la retirada de las vacunas es un error histórico, las vacunas han salvado cientos de millones de vidas desde el siglo XVIII y han mejorado enormemente las condiciones higiénico sanitarias de nuestro mundo, disminuyendo exponencialmente la mortalidad infantil y las plagas en general, vistas durante siglos y siglos, como la erradicación global de la viruela.</p>
<p>Cierto es que ha habido muchas quejas con las vacunas por contener aluminio, que es toxico o conservantes como el timerosal que es peligroso en niños, pero estos componentes se han ido retirando poco a poco durante los últimos 18 años, hasta que la mayoría de las vacunas pediátricas no contienen timerosal, ni compuestos que puedan ser tóxicos para el organismo, y a pesar de ello, la prevalencia no se vio afectada.</p>
<p>Aceptar la teoría de los antivacunas, de que estas producen el autismo, cuando este no se contrae como estoy explicando, ni es una enfermedad es caer en un error doblemente peligroso, por una parte da lugar a entender que la neurodiversidad es una enfermedad que se debe curar y por otro lado se expone a los menores al riesgo de enfermedades como el sarampión, las paperas, la rubeola, etc…enfermedades erradicadas de los países del primer mundo y que por la ignorancia de los antivacunas están volviendo a aparecer, dejando víctimas infantiles sobre la mesa, a expensas de que lo contagien a terceras personas.</p>
<p>En resumen, podemos decir que los fármacos se pueden utilizar en las personas con autismo en casos de agresividad, de depresión o de otras coocurrencias que nos genere el ambiente, pero quiero dejar claro que cualquier persona neurotípica que sufra el mismo tipo de estrés y se desquicie recurrirá al mismo tipo de medicamentos que nosotros.</p>
<p>Por ello no se debe ocultar la esencia autística, que al final se basa en una forma de manejo social distinta, y no debemos sentir pudor a reivindicarla, y no tener miedo a ser insultado, despedido, acosado o humillado, es poder decir al mundo lo que soy sin tener que avergonzarme ni taparme la cara ni bajar la mirada. Y en esto consiste de la vida y el ser feliz: en aceptarte cómo eres, pues al final los mayores prejuicios y las mayores barreras nos las ponemos nosotros mismos.</p>
<p>Ver como hay personas en el amplio espectro del autismo que se avergüenzan de su condición por temor a presiones sociales me parece algo horrible, no solo es intentar aparentar lo que no eres, es renegar de tu personalidad, de tu esencia, de lo que eres para intentar ser como otros, y eso es no quererse a uno mismo.</p>
<p>La palabra “enfermo” es violenta y una agresión hacia la identidad de la persona. Yo mismo en la universidad autónoma sufrí esta agresión por parte de un compañero que me llamo enfermo delante de todo el mundo en redes sociales en un evento que quería hacer sobre el autismo, este insulto que hacen algunos neurotípicos puede marcarnos de por vida y entonces empeorar nuestros síntomas que ya tenemos de una presión excesiva ya de por sí del mundo neurotípico. Por eso, preferimos divulgar nuestra realidad, esa que no hace que seamos superiores ni mejores, sencillamente gente diferente, que busca algo tan sencillo en la vida como la paz y el amor, si eso es estar enfermo, entonces, todos lo estamos.</p>
<p>Por ello es muy importante la labor que yo y otras personas con y sin autismo llevamos a cabo de explicar a la sociedad que no somos enfermos y que no hay que intentar curarnos, sino intentar comprendernos, que todo el esfuerzo de comprensión no tengamos que hacerlo nosotros, sino que sea un feedback con vosotros.</p>
<p>Al fin y al cabo, el TEActivismo es una lucha por la igualdad y los derechos humanos y las personas con TEA somos eso, seres humanos, no “enfermos”. Por  Ignacio Pantoja 1-03-2018 <a href="https://autismodiario.org/2018/03/01/autismo-no-una-enfermedad/">https://autismodiario.org/</a></p>
</article>
</section>
<?php
//footer
require ("footer.php");
?>
<br><br>
</body>
</html>
<?php
mysqli_close($conexion);
?>
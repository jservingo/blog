<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Type;
use App\Post;
use App\Photo;
use App\Tag;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Storage::disk('public')->deleteDirectory('posts');

        $post = new Post; // 10
        $post->title = "Salto Ángel - Venezuela";
        $post->excerpt = "Es el salto de agua más alto del mundo, con una altura de 979 m (807 m de caída ininterrumpida),​ generada desde el Auyantepuy";
        $post->body = "<p>Se localiza en el Parque nacional Canaima, en el estado Bolívar, Venezuela. Un espacio natural protegido, establecido como Parque nacional el 12 de junio de 1962 y declarado4​ Patrimonio de la Humanidad por la Unesco en 1994, se extiende sobre un área de más de 30.000 km² (similar a la extensión territorial de Bélgica), hasta la frontera con Brasil y el territorio del Esequibo (actualmente en reclamación).</p><p>El nombre con el que es conocido internacionalmente, Salto Ángel, fue sugerido por un venezolano en honor al aviador estadounidense Jimmie Angel, que en el año 1937 colaboró más formalmente en la existencia y ubicación exacta de la caída al sobrevolarla en su avioneta y más tarde posarse en su cima, dándole con esto repercusión mundial.</p><p>En el siglo XXI, fue una de las 28 finalistas en la elección de las Siete maravillas naturales del mundo.</p>";
        $post->published_at = Carbon::now()->subDays(10);
        $post->type_id = 1;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(1, array('user_id' => 1)); 

        $photo = new Photo;
        $photo->post_id = 1;
        $photo->user_id = 1;
        $photo->url = "posts/churunmeru.jpg";
        $photo->description = "Salto Ángel";
        $photo->save();

        $post = new Post; // 9 Youtube video
        $post->title = "The Cure - Just Like Heaven";
        $post->excerpt = "Es el decimoséptimo sencillo de la banda británica de rock alternativo The Cure. El grupo escribió gran parte de la canción durante las sesiones de grabación en el sur de Francia en 1987. La letra fue escrita por el líder de la banda, Robert Smith, quien se inspiró en un viaje pasado a la orilla del mar con su futura esposa. Antes de que Smith completara la letra, una versión instrumental de la canción fue usada como tema para el programa de televisión francés Les Enfants du Rock.";
        $post->body = "Show me, show me, show me how you do that trick<br>The one that makes me scream she said<br>The one that makes me laugh she said<br>Threw her arms around my neck<br>Show me how you do it and I'll promise you<br>I'll promise that I'll run away with you, I'll run away with you<br>Spinning on that dizzy edge<br>Kissed her face and kissed her head<br>Dreamed of all the different ways, I had to make her glow<br>Why are you so far away she said<br>Why won't you ever know that I'm in love with you?<br>That I'm in love with you?<br>You, soft and only, you lost and lonely<br>You, strange as angels<br>Dancing in the deepest oceans<br>Twisting in the water<br>You're just like a dream<br>You're just like a dream<br>Daylight licked me into shape<br>I must have been asleep for days<br>And moving lips to breathe her name<br>I opened up my eyes<br>And found myself alone, alone, alone above a raging sea<br>That stole the only girl I loved and drowned her deep inside of me<br>You soft and only<br>You lost and lonely<br>You just like heaven";
        $post->iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/n3nPiBai66M" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>'; 
        $post->published_at = Carbon::now()->subDays(9);
        $post->type_id = 2;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(2, array('user_id' => 2));

        $post = new Post; // 8
        $post->title = "Arepera el Tropezón";
        $post->excerpt = "La icónica arepera El Tropezón, ubicada en Los Chaguaramos de Caracas, cerró sus puertas luego de 50 años de servicio, debido a los altos precios de los productos y luego del último aumento salarial a mil 800 bolívares anunciado por el presidente Nicolás Maduro, según varios reportes.";
        $post->body = "";
        $post->published_at = Carbon::now()->subDays(8);
        $post->type_id = 4;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(2, array('user_id' => 4)); 

        $post = new Post; // 7
        $post->title = "La decadencia del Teatro Teresa Carreño";
        $post->excerpt = "El principal Complejo Cultural del país, y uno de los teatros más importantes de América Latina,  bajó el telón y tiene un año sin realizar presentaciones en sus famosas salas: la Ríos Reyna y la José Félix Ribas.";
        $post->body = "<p>El principal Complejo Cultural del país, y uno de los teatros más importantes de América Latina,  bajó el telón y tiene un año sin realizar presentaciones en sus famosas salas: la Ríos Reyna y la José Félix Ribas. La situación del país hunde al teatro Teresa Carreño en la sombra; por lo que ahora, la función no puede continuar.</p><p>Los protagonistas del Teresa Carreño hoy son distintos: la oscuridad es la reina de los pasillos que solo se iluminan con los rayos de sol que entran del exterior; las jardinerías perdieron su color verdoso, ahora están descoloridas; el piso está cubierto por una gran capa de polvo, ya no brilla como antes; los robos son los antihéroes y el abandono, el tema central.</p><p>A 35 años de fundación, la época dorada del teatro quedó atrás. El deterioro lleva años acumulándose y se intensificó desde que el gobierno de Nicolás Maduro ordenó su intervención en 2014 y nombró a una junta interventora que estaría a cargo del teatro solo por seis meses, con la finalidad de hacer una reestructuración. Sin embargo, la realidad es que a cinco años de eso la junta sigue allí y no hay rastro de que se haya hecho mantenimiento a las instalaciones; por el contrario, la política de mantenimiento que existía desapareció.</p>";
        $post->published_at = Carbon::now()->subDays(7);
        $post->type_id = 3;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(2, array('user_id' => 3));

        $post = new Post; // 6 Youtube video
        $post->title = "The Cure - A Forest";
        $post->excerpt = "Es el cuarto sencillo editado por la banda británica The Cure, el único que se extrajo de su segundo álbum, Seventeen Seconds (1980).";
        $post->body = "<p>La letra cuenta la historia de un hombre que busca a una mujer en un bosque. El hombre oye cómo la llama desde la lejanía, y corre hacia ella hacia lo profundo del bosque, pero de pronto se detiene para darse cuenta de que se ha perdido y que la mujer no está allí.</p><p>La canción tiene un tono distinto al del resto del álbum. La batería de Laurence Tolhurst, semejante a una caja de ritmos, y las frenéticas líneas de bajo de Simon Gallup consiguen alimentar la atmósfera de la persecución por el bosque. Algunos críticos consideran que dicha canción es la que mejor resume el sonido de The Cure.</p><p>La canción fue la primera en aparecer en Top of the Pops y ha sido regrabada varias veces por The Cure, entre otras ocasiones para los recopilatorios Mixed Up y Join the Dots. Se han realizado numerosas versiones de la canción, como la de Nouvelle Vague en su álbum de debut.</p><p>Es muy frecuente en las actuaciones en directo del grupo, donde se realizan versiones que alargan la canción. Algunas de dichas versiones en directo han llegado a durar 20 minutos.</p>";
        $post->iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/x83wluZqM2g" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $post->published_at = Carbon::now()->subDays(6);
        $post->type_id = 2;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(3, array('user_id' => 2));

        $post = new Post; // 5 Soundcloud
        $post->title = "Close To Me - Remake from scratch";
        $post->excerpt = "Close to Me es el decimotercer sencillo editado por la banda británica The Cure. Fue lanzado como segundo sencillo del álbum The head on the door. Fue el lanzamiento más exitoso de la banda hasta ese momento, alcanzando el cuarto puesto entre los más vendidos en Irlanda y la séptima posición en Australia. El relanzamiento de 1990 se convirtió en el decimotercero más vendido Reino Unido.";
        $post->body = "<p>Existen dos versiones de Close to Me, una con una sección de viento y otra sin ella. La versión sin la sección de viento es la que se contiene originalmente en el álbum The Head on the Door, mientras la otra es que la que aparece en el sencillo. La sección de viento fue adaptada de una marcha fúnebre tradicional de Nueva Orleans. La remezcla extendida para el sencillo de 12 pulgadas contiene un arreglo extendido de dicha sección de viento. Las versiones con instrumentos de viento también contienen, al comienzo del tema, un sonido largo y chirriante de una puerta al cerrarse. Este sonido fue extraído del comienzo del vídeo musical que se grabó para este tema, en el que aparece la banda atrapada en un armario que cae de un acantilado y se hunde en el mar. </p>";
        $post->iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/BWySzNhhav0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $post->published_at = Carbon::now()->subDays(5);
        $post->type_id = 2;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(3, array('user_id' => 2));

        $post = new Post; // 4
        $post->title = "Los Médanos de Coro";
        $post->excerpt = "Los Médanos de Coro son formaciones de arena características del relieve del estado Falcon, siendo este parte del sistema Lara-Falcón por sus dunas que sobrepasan los 8 msnm.";
        $post->body = "<p>Las arenas suaves y secas de este Parque Nacional son consecuencia de la erosión eólica sobre las rocas que con el tiempo son partidas en pedazos muy pequeños convirtiéndolas en arenilla y ésta, al desplazarse por la continua acción del viento, se va acumulando en parvas, convirtiéndose poco a poco a dunas que continuamente cambian de forma ya que están en continuo movimiento.​ Por ello también los médanos han recibido el nombre de arenas nómadas.​</p>";
        $post->published_at = Carbon::now()->subDays(4);
        $post->type_id = 1;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(3, array('user_id' => 1));

        $photo = new Photo;
        $photo->post_id = 7;
        $photo->user_id = 1;
        $photo->url = "posts/MedanosCoro.jpg";
        $photo->description = "Médanos de Coro";
        $photo->save();

        $post = new Post; // 3
        $post->title = "Google invertirá 140 millones para ampliar su data center de Latinoamérica";
        $post->excerpt = "";
        $post->body = "";
        $post->url = "http://www.2001.com.ve/tecnologia/193354/google-invertira-140-millones-para-ampliar-su--data-center--de-latinoamerica.html";
        $post->published_at = Carbon::now()->subDays(3);
        $post->type_id = 5;
        $post->user_id = 1;
        $post->save();
        $post->tags()->attach(3, array('user_id' => 4));

        $post = new Post; // 2
        $post->title = "Teatro Municipal de Caracas";
        $post->excerpt = "El Teatro Municipal de Caracas Alfredo Sadel es un espacio dedicado a la representación de óperas, espectáculos musicales y obras de teatro, y uno de los más importantes de Caracas hasta la inauguración del Teatro Teresa Carreño en 1983. Está ubicado en el centro histórico de la ciudad, en la esquina Municipal de El Silencio.";
        $post->body = "<p>El teatro fue inaugurado con el nombre de Teatro Guzmán Blanco, el 1 de enero de 1881 por Antonio Guzmán Blanco. Su construcción fue iniciada en 1876 por el arquitecto francés Esteban Aricar y completada a partir de 1879 por el Venezolano Jesús Muñoz Tébar. En la inauguración se ofreció una representación de la ópera El trovador que fue realizada por Giuseppe Verdi, con la Compañía de Ópera Italiana Afortunar Corvaba.</p><p>Es una de las salas de ópera más antiguas de Sudamérica después del Teatro Solís de Montevideo (1856) y antes que el Teatro Nacional Sucre de Quito (1886), el Teatro de Cristóbal Colón de Bogotá (1892), el Teatro Amazonas de Manaos (1896) y el Teatro Colón de Buenos Aires (1908).</p><p>En 1888 es renombrado Teatro Municipal. En 1905 se inaugura el Teatro Nacional que durante años competiría con el Municipal y el desaparecido Teatro Caracas en la escena teatral caraqueña. En 1930 fue renovado, reabriéndose el 29 de noviembre de ese año con una representación de la ópera Turandot.</p>";
        $post->published_at = Carbon::now()->subDays(2);
        $post->type_id = 1;
        $post->user_id = 2;
        $post->save();
        $post->tags()->attach(3, array('user_id' => 3));

        $photo = new Photo;
        $photo->post_id = 9;
        $photo->user_id = 1;
        $photo->url = "posts/TeatroMunicipalCaracas.jpg";
        $photo->description = "Teatro Municipal de Caracas";
        $photo->save();

        $post = new Post; // 1 Soundcloud
        $post->title = "Depeche Mode - Enjoy The Silence (Extended Version)";
        $post->excerpt = "Es el vigésimo cuarto disco sencillo del grupo inglés de música electrónica Depeche Mode, el segundo desprendido de su álbum Violator, publicado en 1990.";
        $post->body = "<p>Enjoy the Silence fue una canción compuesta, grabada y cantada por Martin Gore de manera acústica, sin embargo Alan Wilder encontró potencial en ella, por lo cual realizó una musicalización de base electrónica rítmica más sofisticada. Los otros miembros del grupo estuvieron satisfechos con el resultado; Gore agregó partes de guitarra y por último cedió las vocales a David Gahan, acompañándolo sólo en los coros. Enjoy the Silence se convirtió, después del tratamiento de Wilder, en uno de los más emblemáticos temas de Depeche Mode hasta la fecha.</p>";
        $post->iframe = '<iframe width="560" height="315" src="https://www.youtube.com/embed/-_3dc6X-Iwo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->type_id = 2;
        $post->user_id = 2;
        $post->save();
        $post->tags()->attach(4, array('user_id' => 2));
    }
}

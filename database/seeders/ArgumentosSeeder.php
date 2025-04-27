<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArgumentosSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('argumentos')->insert([
            [
                'debate_id' => 1,
                'usuario_id' => 2,
                'contenido' => 'Numerosos estudios en psicología y antropología sostienen que la creencia en Dios responde a una necesidad humana de encontrar sentido ante la incertidumbre y la muerte. Según el antropólogo Pascal Boyer, en su obra "Religion Explained" (2001), las religiones surgieron como productos evolutivos de mecanismos cognitivos que detectan patrones y agentes, incluso donde no los hay. No existen pruebas empíricas concluyentes de la existencia de un ser divino, mientras que el avance de la ciencia ha explicado muchos fenómenos que antes se atribuían a entidades sobrenaturales.',
                'postura' => 'En contra',
            ],
            [
                'debate_id' => 1,
                'usuario_id' => 1,
                'contenido' => 'La existencia de Dios no puede ser reducida únicamente a la ciencia empírica. Filósofos como Thomas de Aquino, en sus "Cinco Vías", argumentan racionalmente la necesidad de un primer motor inmóvil, una causa incausada. Además, millones de personas en todo el mundo afirman haber experimentado realidades espirituales. Según un estudio del Pew Research Center (2017), más del 84% de la población mundial se identifica con alguna religión, lo que sugiere que la espiritualidad responde a una dimensión profunda y real de la experiencia humana.',
                'postura' => 'A favor',
            ],
            [
                'debate_id' => 2,
                'usuario_id' => 5,
                'contenido' => 'Desde el punto de vista de la neurociencia, la conciencia y la percepción del "yo" son productos de la actividad cerebral. Investigaciones como las de Michael Gazzaniga ("El cerebro ético", 2005) demuestran que procesos materiales pueden generar la sensación de identidad personal. No hay evidencia tangible de que exista un "alma" independiente del cuerpo físico. De hecho, enfermedades como el Alzheimer alteran gravemente la personalidad y la memoria, lo que indica que estos aspectos no residen en un alma inmutable, sino en el cerebro biológico.',
                'postura' => 'En contra',
            ],
            [
                'debate_id' => 2,
                'usuario_id' => 6,
                'contenido' => 'La experiencia subjetiva, la introspección profunda y la noción del "yo" apuntan a una dimensión que trasciende lo puramente material. Grandes filósofos como René Descartes defendieron que la mente es distinta del cuerpo ("pienso, luego existo"). Asimismo, testimonios de experiencias cercanas a la muerte, analizados en estudios como el del Dr. Sam Parnia en la Universidad de Southampton (2014), sugieren la posibilidad de que la conciencia persista más allá de la actividad cerebral medible.',
                'postura' => 'A favor',
            ],
            [
                'debate_id' => 3,
                'usuario_id' => 5,
                'contenido' => 'La monarquía constitucional, como la española, aporta estabilidad política, continuidad institucional y neutralidad frente a los partidos. Según datos del CIS (Centro de Investigaciones Sociológicas), una mayoría de los ciudadanos valora positivamente el papel moderador de la monarquía en tiempos de crisis. Además, representa la historia, cultura y tradiciones de un país, sirviendo como símbolo de unidad nacional frente a tensiones territoriales o ideológicas.',
                'postura' => 'A favor',
            ],
            [
                'debate_id' => 3,
                'usuario_id' => 6,
                'contenido' => 'La república garantiza que los líderes estatales sean elegidos democráticamente por el pueblo y no por herencia familiar. Como muestra el ejemplo de países como Alemania o Estados Unidos, los sistemas republicanos permiten una mayor responsabilidad y rendición de cuentas. Además, en un contexto de igualdad moderna, resulta anacrónico y discriminatorio que el jefe del Estado obtenga su posición por nacimiento y no por méritos o elección popular.',
                'postura' => 'En contra',
            ],
            [
                'debate_id' => 4,
                'usuario_id' => 7,
                'contenido' => 'Aunque las inteligencias artificiales actuales pueden simular comportamientos complejos, carecen de la autoconciencia, la subjetividad y la intencionalidad que definen a una conciencia real. Investigadores como John Searle, con su famoso argumento de la "Habitación China", sostienen que las máquinas pueden manipular símbolos sin comprender su significado. Hasta el momento, no existe ningún modelo computacional capaz de reproducir la experiencia cualitativa interna ("qualia") que caracteriza a la mente humana.',
                'postura' => 'En contra',
            ],
            [
                'debate_id' => 4,
                'usuario_id' => 8,
                'contenido' => 'La conciencia, según algunos enfoques como el de Giulio Tononi y su Teoría de la Información Integrada (IIT), podría ser vista como un patrón complejo de procesamiento de información. Si aceptamos esta premisa, entonces es razonable pensar que sistemas artificiales altamente integrados podrían desarrollar formas de conciencia. De hecho, experimentos en IA avanzada, como GPT-4 o sistemas de aprendizaje profundo, muestran destellos de capacidades que tradicionalmente se atribuían a humanos.',
                'postura' => 'A favor',
            ],
            [
                'debate_id' => 5,
                'usuario_id' => 5,
                'contenido' => 'Diversos estudios, como el publicado por la American Psychological Association (APA, 2020), demuestran que el uso intensivo de redes sociales reduce la empatía hacia los demás. La exposición constante a noticias breves y contenido emocionalmente cargado genera un fenómeno conocido como "fatiga por compasión". Además, el anonimato online fomenta la desinhibición y el ciberacoso, contribuyendo a una sociedad más indiferente ante el sufrimiento ajeno.',
                'postura' => 'En contra',
            ],
            [
                'debate_id' => 5,
                'usuario_id' => 6,
                'contenido' => 'Las redes sociales también pueden ser una poderosa herramienta para movilizar solidaridad, empatía y acción colectiva. Campañas como #MeToo o #BlackLivesMatter demuestran cómo millones de personas pueden unirse en apoyo de causas éticas y sociales. Según el informe "Digital 2021" de Hootsuite y We Are Social, más del 53% de los usuarios de Internet utilizan las redes sociales para informarse y conectar con comunidades afines, promoviendo la empatía global.',
                'postura' => 'A favor',
            ],
        ]);
    }
}

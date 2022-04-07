<?php

use Illuminate\Database\Seeder;

class PersonaTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'nombre' => 'FERNANDO', 
                'apaterno' => 'ABULARACH',
                'amaterno' => 'SUAREZ',
                'numeroregistro' =>  '2988',
            ],
            [
                'nombre' => 'ALFREDO', 
                'apaterno' => 'ASCARRUNZ',
                'amaterno' => 'RIVERO',
                'numeroregistro' =>  '191',
            ],
            [
                'nombre' => 'ELIO',
                'apaterno' => 'ACHOCALLA',
                'amaterno' => 'FLORES',
                'numeroregistro' =>  '12737',
            ],
            [
                'nombre' => 'JOSELYNE',
                'apaterno' => 'ADAD',
                'amaterno' => 'DURAN',
                'numeroregistro' =>  '15195',
            ],
            [
                'nombre' => 'JUAN CARLOS',
                'apaterno' => 'AGUIRRE',
                'amaterno' => 'DELLIEN',
                'numeroregistro' =>  '5605',
            ],
            [
                'nombre' => 'CARLOS ERNESTO',
                'apaterno' => 'AGUIRRE',
                'amaterno' => 'DELLIEN',
                'numeroregistro' =>  '8573',
            ],
            [
                'nombre' => 'RAUL',
                'apaterno' => 'AGUIRRE',
                'amaterno' => 'GUZMAN',
                'numeroregistro' =>  '14698',
            ],
            [
                'nombre' => 'SVIETLANA', 
                'apaterno' => 'ALCON',
                'amaterno' => 'ORDOÑEZ',
                'numeroregistro' =>  '7086',
            ],
            [
                'nombre' => 'SVIETLANA', 
                'apaterno' => 'ALCON',
                'amaterno' => 'ORDOÑEZ',
                'numeroregistro' =>  '7086',
            ],
            [
                'nombre' => 'FABIOLA', 
                'apaterno' => 'ANTELO',
                'amaterno' => 'HURTADO',
                'numeroregistro' =>  '12029',
            ],
            [
                'nombre' => 'RODOLFO',
                'apaterno' => 'ANTELO',
                'amaterno' => 'PARADA',
                'numeroregistro' =>  '5718',
            ],
            [
                'nombre' => 'JESUS', 
                'apaterno' => 'ALI',
                'amaterno' => 'SANGUINO',
                'numeroregistro' =>  '9626',
            ],
            [
                'nombre' => 'WENDY AMANDA',
                'apaterno' => 'AGUILERA',
                'amaterno' => 'GUTIERREZ',
                'numeroregistro' =>  '7994',
            ],
            [
                'nombre' => 'RAMIRO', 
                'apaterno' => 'AÑEZ',
                'amaterno' => 'ANTELO',
                'numeroregistro' =>  '7995',
            ],
            [
                'nombre' => 'MIGUEL ALEJANDRO',
                'apaterno' => 'ARENAS',
                'amaterno' => 'PARDO',
                'numeroregistro' =>  '7900',
            ],
            [
                'nombre' => 'JUAN MARCELO',  
                'apaterno' => 'ARANIBAR',
                'amaterno' => 'SOTO',
                'numeroregistro' =>  '7161',
            ],
            [
                'nombre' => 'CARLOS ANDRES',
                'apaterno' => 'ARZE',
                'amaterno' => 'ALARCON',
                'numeroregistro' =>  '9158',
            ],
            [
                'nombre' => 'YASKARA AIDA',
                'apaterno' => 'ARTEAGA',
                'amaterno' => 'KREBBER',
                'numeroregistro' =>  '2555',
            ],
            [
                'nombre' => 'WEIMAR FEDERICO',
                'apaterno' => 'ARROYO',
                'amaterno' => 'IRAHOLA',
                'numeroregistro' =>  '12288',
            ],
            [
                'nombre' => 'XIMENA',
                'apaterno' => 'AVILA',
                'amaterno' => 'RODRIGUEZ',
                'numeroregistro' =>  '2468',
            ],
            [
                'nombre' => 'MONICA SHIRLEY',
                'apaterno' => 'AVILA',
                'amaterno' => 'RODRIGUEZ',
                'numeroregistro' =>  '4911',
            ],
            [
                'nombre' => 'BLANCA ALICIA', 
                'apaterno' => 'BALCAZAR',
                'amaterno' => 'GUTIERREZ',
                'numeroregistro' =>  '1606',
            ],
            [
                'nombre' => 'MARCOS',
                'apaterno' => 'BALCAZAR',
                'amaterno' => 'ROCHA',
                'numeroregistro' =>  '5580',
            ],
            [
                'nombre' => 'PEDRO ANTONIO', 
                'apaterno' => 'BALCAZAR',
                'amaterno' => 'LEIGUE',
                'numeroregistro' =>  '6502',
            ],
            [
                'nombre' => 'LUIS ENRIQUE', 
                'apaterno' => 'BALDERRAMA',
                'amaterno' => 'MONTERO',
                'numeroregistro' =>  '6138',
            ],
            [
                'nombre' => 'LUIS ALBERTO',
                'apaterno' => 'BARRANCOS',
                'amaterno' => 'SEOANE',
                'numeroregistro' =>  '3309',
            ],
            [
                'nombre' => 'ABRAHAN',
                'apaterno' => 'BARBA',
                'amaterno' => 'ZABALA',
                'numeroregistro' =>  '12241',
            ],
            [
                'nombre' => 'EDWIN',
                'apaterno' => 'BAUSE',
                'amaterno' => 'VILLAR',
                'numeroregistro' =>  '2989',
            ],
            [
                'nombre' => 'BEISMARCK EDGAR',
                'apaterno' => 'BECERRA',
                'amaterno' => 'MONTERO',
                'numeroregistro' =>  '10283',
            ],
            [
                'nombre' => 'VERONICA', 'BELLO', 'REY', '11147'
                'apaterno' => 'BELLO',
                'amaterno' => 'REY',
                'numeroregistro' =>  '11147',
            ],
            [
                'nombre' => 'JORGE EDISON', 
                'apaterno' => 'BRAVO',
                'amaterno' => 'SELUM',
                'numeroregistro' =>  '440',
            ],
            [
                'nombre' => 'PRISCILA',
                'apaterno' => 'BRUCKNER',
                'amaterno' => 'TITIBOCO',
                'numeroregistro' =>  '14964',
            ],
            [
                'nombre' => 'MAURICIO',
                'apaterno' => 'CALVO',
                'amaterno' => 'RIOJA',
                'numeroregistro' =>  '6008',
            ],
            [
                'nombre' => 'DANIEL ALEJANDRO',
                'apaterno' => 'CALLAU',
                'amaterno' => 'ZABALA',
                'numeroregistro' =>  '4717',
            ],
            [
                'nombre' => 'MARIA ELENA', 
                'apaterno' => 'CALLAU',
                'amaterno' => 'ZABALA',
                'numeroregistro' =>  '7866',
            ],
            [
                'nombre' => 'CARLOS ALBERTO',
                'apaterno' => 'CALLAU',
                'amaterno' => 'ZABALA',
                'numeroregistro' =>  '8529',
            ],
            [
                'nombre' => 'VRISLEY MAURICIO', 
                'apaterno' => 'CAMBERO',
                'amaterno' => 'HERRERA',
                'numeroregistro' =>  '10211',
            ],
            [
                'nombre' => 'IVAN JESUS',
                'apaterno' => 'CASTRO',
                'amaterno' => 'ROCA',
                'numeroregistro' =>  '4159',
            ],
            [
                'nombre' => 'MARCO ANTONIO', 
                'apaterno' => 'CAYUBA',
                'amaterno' => 'TERCEROS',
                'numeroregistro' =>  '7171',
            ],
            [
                'nombre' => 'FABIO MIRKO', 
                'apaterno' => 'CAZZOL',
                'amaterno' => 'SANDOVAL',
                'numeroregistro' =>  '12289',
            ],
            [
                'nombre' => 'FERNANDO', 
                'apaterno' => 'CESPEDES',
                'amaterno' => 'SOLIZ',
                'numeroregistro' =>  '4312',
            ],
            [
                'nombre' => 'RODOLFO',
                'apaterno' => 'COIMBRA',
                'amaterno' => 'CANIDO',
                'numeroregistro' =>  '1605',
            ],
            [
                'nombre' => 'RONALD ANDRES', 
                'apaterno' => 'COSSIO',
                'amaterno' => 'BLANCO',
                'numeroregistro' =>  '10685',
            ],
            [
                'nombre' => 'DAVID',
                'apaterno' => 'CORTEZ',
                'amaterno' => 'ROSSEL',
                'numeroregistro' =>  '14836',
            ],
            [
                'nombre' => 'RONALD ANDRES', 
                'apaterno' => 'COSSIO',
                'amaterno' => 'BLANCO',
                'numeroregistro' =>  '10685',
            ],
            [
                'nombre' => 'RONALD ANDRES', 
                'apaterno' => 'COSSIO',
                'amaterno' => 'BLANCO',
                'numeroregistro' =>  '10685',
            ],
            [
                'nombre' => 'RONALD ANDRES', 
                'apaterno' => 'COSSIO',
                'amaterno' => 'BLANCO',
                'numeroregistro' =>  '10685',
            ],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}

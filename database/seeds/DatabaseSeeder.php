<?php

use Illuminate\Database\Seeder;
use App\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->poblarUsers();
        $this->poblarSections();
        $this->poblarContenido();
    }

    public function poblarContenido(){
        DB::table('contents')->insert([
            'section' => 1,
            'titulo' => 'Grand Theft Auto V',
            'motivo' => 'Aprobado',
            'sipnosis' => 'Grand Theft Auto V es un videojuego de acción-aventura de mundo abierto desarrollado por el estudio Rockstar North y distribuido por Rockstar Games. Fue lanzado el 17 de septiembre de 2013 para las consolas PlayStation 3 y Xbox 360. Posteriormente, fue lanzado el 18 de noviembre de 2014 para las consolas de nueva generación PlayStation 4 y Xbox One con mejores gráficos y novedades interesantes como la vista en primera persona y finalmente para Microsoft Windows el 14 de abril de 2015. Se trató del primer gran título en la serie Grand Theft Auto desde el lanzamiento de Grand Theft Auto IV en 2008, el cual estrenó la «era HD» de la mencionada serie de videojuegos.',
            'urlimage1' => 'gta1.jpg',
            'urlimage2' => 'gta2.jpg',
            'urlimage3' => 'gta3.jpg',
            'version' => 1,
            'urlcompra' => 'https://www.epicgames.com/store/es-MX/product/grand-theft-auto-v/',
            'vigencia' => '2020-06-08 13:45:00',
            'isAprobado' => 1,
        ]);
        DB::table('versiones')->insert([
            'content' => 1,
            'version' => 1,
            'motivo' => 'Aprobado',
            'titulo' => 'Grand Theft Auto V',
            'sipnosis' => 'Grand Theft Auto V es un videojuego de acción-aventura de mundo abierto desarrollado por el estudio Rockstar North y distribuido por Rockstar Games. Fue lanzado el 17 de septiembre de 2013 para las consolas PlayStation 3 y Xbox 360. Posteriormente, fue lanzado el 18 de noviembre de 2014 para las consolas de nueva generación PlayStation 4 y Xbox One con mejores gráficos y novedades interesantes como la vista en primera persona y finalmente para Microsoft Windows el 14 de abril de 2015. Se trató del primer gran título en la serie Grand Theft Auto desde el lanzamiento de Grand Theft Auto IV en 2008, el cual estrenó la «era HD» de la mencionada serie de videojuegos.',
            'urlimage1' => 'gta1.jpg',
            'urlimage2' => 'gta2.jpg',
            'urlimage3' => 'gta3.jpg',
            'version' => 1,
            'urlcompra' => 'https://www.epicgames.com/store/es-MX/product/grand-theft-auto-v/',
            'vigencia' => '2020-06-08 13:45:00',
            'isAprobado' => 1,
        ]);

        DB::table('contents')->insert([
            'section' => 2,
            'titulo' => 'FIFA 20',
            'motivo' => 'Aprobado',
            'sipnosis' => 'FIFA 20 es un videojuego de simulación de fútbol desarrollado por EA Sports, como parte de la serie FIFA de Electronic Arts. Está disponible en las plataformas de PlayStation 4, Xbox One, Microsoft Windows y Nintendo Switch. EA Sports lanzó la demo el 10 de septiembre de ese año y el juego el día 27 del mismo.',
            'urlimage1' => 'fifa1.jpeg',
            'urlimage2' => 'fifa2.jpeg',
            'urlimage3' => 'fifa3.jpeg',
            'version' => 1,
            'urlcompra' => 'https://www.ea.com/es-es/games/fifa/fifa-20',
            'vigencia' => '2020-06-08 13:45:00',
            'isAprobado' => 1,
        ]);
        DB::table('versiones')->insert([
            'content' => 2,
            'version' => 1,
            'motivo' => 'Aprobado',
            'titulo' => 'FIFA 20',
            'sipnosis' => 'FIFA 20 es un videojuego de simulación de fútbol desarrollado por EA Sports, como parte de la serie FIFA de Electronic Arts. Está disponible en las plataformas de PlayStation 4, Xbox One, Microsoft Windows y Nintendo Switch. EA Sports lanzó la demo el 10 de septiembre de ese año y el juego el día 27 del mismo.',
            'urlimage1' => 'fifa1.jpeg',
            'urlimage2' => 'fifa2.jpeg',
            'urlimage3' => 'fifa3.jpeg',
            'version' => 1,
            'urlcompra' => 'https://www.ea.com/es-es/games/fifa/fifa-20',
            'vigencia' => '2020-06-08 13:45:00',
            'isAprobado' => 1,
        ]);

        DB::table('contents')->insert([
            'section' => 4,
            'titulo' => 'Resident Evil 2',
            'motivo' => 'Sin revisar',
            'sipnosis' => 'Resident Evil 2 —cuyo título original en Japón es Biohazard 2 — es un videojuego de disparos en tercera persona perteneciente al género de horror de supervivencia, desarrollado y publicado por Capcom, se trata de una nueva versión del videojuego homónimo de 1998.',
            'urlimage1' => 'res1.jpeg',
            'urlimage2' => 'res2.jpeg',
            'urlimage3' => 'res3.jpeg',
            'version' => 1,
            'urlcompra' => 'https://www.xbox.com/es-MX/games/resident-evil-2',
            'vigencia' => '2020-06-08 13:45:00',
            'isAprobado' => 1,
        ]);
        DB::table('versiones')->insert([
            'content' => 3,
            'version' => 1,
            'motivo' => 'Sin revisar',
            'titulo' => 'Resident Evil 2',
            'sipnosis' => 'Resident Evil 2 —cuyo título original en Japón es Biohazard 2 — es un videojuego de disparos en tercera persona perteneciente al género de horror de supervivencia, desarrollado y publicado por Capcom, se trata de una nueva versión del videojuego homónimo de 1998.',
            'urlimage1' => 'res1.jpeg',
            'urlimage2' => 'res2.jpeg',
            'urlimage3' => 'res3.jpeg',
            'version' => 1,
            'urlcompra' => 'https://www.xbox.com/es-MX/games/resident-evil-2',
            'vigencia' => '2020-06-08 13:45:00',
            'isAprobado' => 1,
        ]);
        DB::table('contents')->insert([
            'section' => 3,
            'titulo' => 'Age of Empires II',
            'motivo' => 'Sin revisar',
            'sipnosis' => 'Age of Empires II (1999, Ensemble Studios) pertenece a ese grupo de juegos de estrategia en tiempo real —RTS por sus siglas en inglés— que ha logrado mantener una comunidad de jugadores activos por más de 15 años. Como muchos otros RTS de la época.',
            'urlimage1' => 'age1.jpeg',
            'urlimage2' => 'age2.jpeg',
            'urlimage3' => 'age3.jpeg',
            'version' => 1,
            'urlcompra' => 'https://store.steampowered.com/app/813780/Age_of_Empires_II_Definitive_Edition/?l=spanish',
            'isAprobado' => 0,
        ]);
        DB::table('versiones')->insert([
            'content' => 4,
            'version' => 1,
            'motivo' => 'Sin revisar',
            'titulo' => 'Age of Empires II',
            'sipnosis' => 'Age of Empires II (1999, Ensemble Studios) pertenece a ese grupo de juegos de estrategia en tiempo real —RTS por sus siglas en inglés— que ha logrado mantener una comunidad de jugadores activos por más de 15 años. Como muchos otros RTS de la época.',
            'urlimage1' => 'age1.jpeg',
            'urlimage2' => 'age2.jpeg',
            'urlimage3' => 'age3.jpeg',
            'version' => 1,
            'urlcompra' => 'https://store.steampowered.com/app/813780/Age_of_Empires_II_Definitive_Edition/?l=spanish',
            'isAprobado' => 0,
        ]);
        DB::table('contents')->insert([
            'section' => 5,
            'titulo' => 'Forza Horizon 4',
            'motivo' => 'Sin revisar',
            'sipnosis' => 'Forza Horizon 4 es un videojuego de carreras de mundo abierto, jugable en línea, desarrollado por Playground Games para Xbox One y Windows 10. Fue revelado en el E3 2018 y su lanzamiento se produjo el 2 de octubre de 2018.',
            'urlimage1' => 'forza1.jpeg',
            'urlimage2' => 'forza2.jpeg',
            'urlimage3' => 'forza3.jpeg',
            'version' => 1,
            'urlcompra' => 'https://www.microsoft.com/es-mx/p/forza-horizon-4/9pnqkhfld2wq?activetab=pivot:overviewtab',
            'isAprobado' => 0,
        ]);
        DB::table('versiones')->insert([
            'content' => 5,
            'version' => 1,
            'motivo' => 'Sin revisar',
            'titulo' => 'Forza Horizon 4',
            'sipnosis' => 'Forza Horizon 4 es un videojuego de carreras de mundo abierto, jugable en línea, desarrollado por Playground Games para Xbox One y Windows 10. Fue revelado en el E3 2018 y su lanzamiento se produjo el 2 de octubre de 2018.',
            'urlimage1' => 'forza1.jpeg',
            'urlimage2' => 'forza2.jpeg',
            'urlimage3' => 'forza3.jpeg',
            'version' => 1,
            'urlcompra' => 'https://www.microsoft.com/es-mx/p/forza-horizon-4/9pnqkhfld2wq?activetab=pivot:overviewtab',
            'isAprobado' => 0,
        ]);
    }

    public function poblarSections(){
        DB::table('sections')->insert([
            'titulo' => 'Acción',
            'descripcion' => 'Los mejores juegos de Acción',
        ]);
        DB::table('sections')->insert([
            'titulo' => 'Deportes',
            'descripcion' => 'Los mejores juegos de Deportes',
        ]);
        DB::table('sections')->insert([
            'titulo' => 'Estrategia',
            'descripcion' => 'Los mejores juegos de Estrategia',
        ]);
        DB::table('sections')->insert([
            'titulo' => 'Terror',
            'descripcion' => 'Los mejores juegos de Terror',
        ]);
        DB::table('sections')->insert([
            'titulo' => 'Carreras',
            'descripcion' => 'Los mejores juegos de Carreras',
        ]);
    }

    public function poblarUsers()
    {
        DB::table('users')->insert([
            'name' => 'Difusor1',
            'email' => 'difusor1@hotmail.com',
            'tipo_usuario' => 'DIFUSOR',
            'password' => bcrypt('12345678'),
            'subscripcion' => 0,
        ]);
        $idUser = User::get()->last();
        DB::table('permisos')->insert([
            'id_user' => $idUser->id,
        ]);
        DB::table('users')->insert([
            'name' => 'Difusor2',
            'email' => 'difusor2@hotmail.com',
            'tipo_usuario' => 'DIFUSOR',
            'password' => bcrypt('12345678'),
            'subscripcion' => 0,
        ]);
        $idUser = User::get()->last();
        DB::table('permisos')->insert([
            'id_user' => $idUser->id,
        ]);
        DB::table('users')->insert([
            'name' => 'Autor1',
            'email' => 'autor1@hotmail.com',
            'tipo_usuario' => 'AUTOR',
            'password' => bcrypt('12345678'),
            'subscripcion' => 0,
        ]);
        $idUser = User::get()->last();
        DB::table('permisos')->insert([
            'id_user' => $idUser->id,
        ]);
        DB::table('users')->insert([
            'name' => 'Autor2',
            'email' => 'autor2@hotmail.com',
            'tipo_usuario' => 'AUTOR',
            'password' => bcrypt('12345678'),
            'subscripcion' => 0,
        ]);
        $idUser = User::get()->last();
        DB::table('permisos')->insert([
            'id_user' => $idUser->id,
        ]);
    }
}

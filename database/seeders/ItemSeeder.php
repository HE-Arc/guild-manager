<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $itemData = array(
            array('name' => 'Tome de Tir tranquillisant', 'rarity' => 'épique', 'type' => 'Livre', 'icon' => '', 'boss_id' => '1'),
            array('name' => 'Bottes d\'arcaniste', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '1'),
            array('name' => 'Gants de Gangrecoeur', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '1'),
            array('name' => 'Bottes cénariennes', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '1'),
            array('name' => 'Bottes judiciaires', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '1'),
            array('name' => 'Gantelets de puissance', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '1'),
            array('name' => 'Collier d\'illumination', 'rarity' => 'épique', 'type' => 'Cou', 'icon' => '', 'boss_id' => '1'),
            array('name' => 'Jambières d\'arcaniste', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Pantalon de Gangrecoeur', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Pantalon de prophétie', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Pantalon du tueur de la nuit', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Jambières cénariennes', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Jambières de traqueur de géant', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Jambières judiciaires', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Jambières de puissance', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Médaillon de Puissance inébranlable', 'rarity' => 'épique', 'type' => 'Cou', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Marque du Frappeur', 'rarity' => 'épique', 'type' => 'À distance', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Trembleterre', 'rarity' => 'épique', 'type' => 'Deux mains', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Griffe droite d\'Eskhandar', 'rarity' => 'épique', 'type' => 'Main droite', 'icon' => '', 'boss_id' => '2'),
            array('name' => 'Gants de prophétie', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '3'),
            array('name' => 'Gants du tueur de la nuit', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '3'),
            array('name' => 'Bottes de traqueur de géant', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '3'),
            array('name' => 'Gantelets judiciaires', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '3'),
            array('name' => 'Sandales de puissance', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '3'),
            array('name' => 'Couronne d\'arcaniste', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Cornes de Gangrecoeur', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Collerette de prophétie', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Couvre-chef du tueur de la nuit', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Casque cénarien', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Casque de traqueur de géant', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Heaume judiciaire', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Casque de puissance', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Disque Drillborer', 'rarity' => 'épique', 'type' => 'Bouclier', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Déchireur de Gutgore', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Marteau d\'Aurastone', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Lame de brutalité', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '4'),
            array('name' => 'Gants d\'arcaniste', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '5'),
            array('name' => 'Mules de Gangrecoeur', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '5'),
            array('name' => 'Bottes de prophétie', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '5'),
            array('name' => 'Bottes du tueur de la nuit', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '5'),
            array('name' => 'Gants cénariens', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '5'),
            array('name' => 'Gants de traqueur de géant', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '5'),
            array('name' => 'Mantelet d\'arcaniste', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '6'),
            array('name' => 'Protège-épaules de Gangrecoeur', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '6'),
            array('name' => 'Spallières cénariennes', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '6'),
            array('name' => 'Spallières judiciaires', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '6'),
            array('name' => 'Sceau de l\'archimagus', 'rarity' => 'épique', 'type' => 'Doigt', 'icon' => '', 'boss_id' => '6'),
            array('name' => 'Robe d\'arcaniste', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Robe de Gangrecoeur', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Robe de prophétie', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Plastron du tueur de la nuit', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Habit cénarien', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Cuirasse de traqueur de géant', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Corselet judiciaire', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Cuirasse de puissance', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Lance-grenaille explosif', 'rarity' => 'épique', 'type' => 'À distance', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Magelame de Chante-azur', 'rarity' => 'épique', 'type' => 'Main droite', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Bâton de domination', 'rarity' => 'épique', 'type' => 'Deux mains', 'icon' => '', 'boss_id' => '7'),
            array('name' => 'Mantelet de prophétie', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '8'),
            array('name' => 'Protège-épaules du tueur de la nuit', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '8'),
            array('name' => 'Epaulettes de traqueur de géant', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '8'),
            array('name' => 'Espauliers de puissance', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '8'),
            array('name' => 'Frappe-ténèbres', 'rarity' => 'épique', 'type' => 'Deux mains', 'icon' => '', 'boss_id' => '8'),
            array('name' => 'Feuille ancienne pétrifiée', 'rarity' => 'épique', 'type' => 'Quête', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'L\'Oeil de la divinité', 'rarity' => 'épique', 'type' => 'Bijou', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Gants de la flamme hypnotique', 'rarity' => 'épique', 'type' => 'Mains', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Anneau de cautérisation', 'rarity' => 'épique', 'type' => 'Doigt', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Grèves du Coeur du Magma', 'rarity' => 'épique', 'type' => 'Pieds', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Spallières de croissance sauvage', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Cape ignifugée', 'rarity' => 'épique', 'type' => 'Dos', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Drague-lave de Finkle', 'rarity' => 'épique', 'type' => 'Deux mains', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Dent de chien du magma', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Echarpe des secrets murmurés', 'rarity' => 'épique', 'type' => 'Taille', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Epaulières de garde du feu', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Garde-poignets de vrai vol', 'rarity' => 'épique', 'type' => 'Poignets', 'icon' => '', 'boss_id' => '9'),
            array('name' => 'Jambières de Stormrage', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Pantalon Rougecroc', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Pantalon de Vent du néant', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Jambières de transcendance', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Jambières de Némésis', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Jambières de traqueur de dragon', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Jambières du jugement', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Jambières de courroux', 'rarity' => 'épique', 'type' => 'Jambes', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Anneau de Précisia', 'rarity' => 'épique', 'type' => 'Doigt', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Fléau de Bonereaver', 'rarity' => 'épique', 'type' => 'Deux mains', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Fragment de la Flamme', 'rarity' => 'épique', 'type' => 'Bijou', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Cape du Voile de brume', 'rarity' => 'épique', 'type' => 'Dos', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Arrache-moelle', 'rarity' => 'épique', 'type' => 'Deux mains', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Défenseur de Malistar', 'rarity' => 'épique', 'type' => 'Bouclier', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Cape sang-de-dragon', 'rarity' => 'épique', 'type' => 'Dos', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Oeil de Sulfuras', 'rarity' => 'légendaire', 'type' => 'Quête', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Collier du Seigneur du Feu', 'rarity' => 'épique', 'type' => 'Cou', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Essence de la Flamme pure', 'rarity' => 'épique', 'type' => 'Bijou', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Lame de la perdition', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Couronne de destruction', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Ceinturon d\'assaut', 'rarity' => 'épique', 'type' => 'Taille', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Anneau de Sulfuras', 'rarity' => 'épique', 'type' => 'Doigt', 'icon' => '', 'boss_id' => '10'),
            array('name' => 'Tête d\'Onyxia', 'rarity' => 'épique', 'type' => 'Quête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Tendon de dragon noir adulte', 'rarity' => 'épique', 'type' => 'Quête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Ancien Grimoire de Cornerstone', 'rarity' => 'épique', 'type' => 'Accessoire pour main gauche', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Anneau de lien', 'rarity' => 'épique', 'type' => 'Doigt', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Drapé de Saphiron', 'rarity' => 'épique', 'type' => 'Dos', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Couronne de Vent du néant', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Crâne de Némésis', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Couvre-chef de Stormrage', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Cagoule Rougecroc', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Casque de traqueur de dragon', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Collier d\'Eskhandar', 'rarity' => 'épique', 'type' => 'Cou', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Heaume de courroux', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Auréole de transcendance', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Couronne du jugement', 'rarity' => 'épique', 'type' => 'Tête', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Eclat de l\'Ecaille', 'rarity' => 'épique', 'type' => 'Bijou', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Porte-mort', 'rarity' => 'épique', 'type' => 'Hache à une main', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Vis\'kag le Saigneur', 'rarity' => 'épique', 'type' => 'Épée à une main', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Sac à dos en cuir d\'Onyxia', 'rarity' => 'épique', 'type' => 'Sac', 'icon' => '', 'boss_id' => '11'),
            array('name' => 'Bague des prières inexaucées', 'rarity' => 'épique', 'type' => 'Doigt', 'icon' => '', 'boss_id' => '12'),
            array('name' => 'Larme de givre', 'rarity' => 'épique', 'type' => 'Cou', 'icon' => '', 'boss_id' => '12'),
            array('name' => 'Gemme de Nérubis', 'rarity' => 'épique', 'type' => 'Accessoire pour main gauche', 'icon' => '', 'boss_id' => '12'),
            array('name' => 'Cape en soie de démon des cryptes', 'rarity' => 'épique', 'type' => 'Dos', 'icon' => '', 'boss_id' => '12'),
            array('name' => 'Garde-poignets de vengeance', 'rarity' => 'épique', 'type' => 'Poignets', 'icon' => '', 'boss_id' => '12'),
            array('name' => 'L\'Etreinte de la veuve', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '13'),
            array('name' => 'Protège-épaules polaires', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '13'),
            array('name' => 'Remords de la veuve', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '13'),
            array('name' => 'Espauliers plaie-de-glace', 'rarity' => 'épique', 'type' => 'Épaules', 'icon' => '', 'boss_id' => '13'),
            array('name' => 'Pendentif de la pierre pernicieuse', 'rarity' => 'épique', 'type' => 'Cou', 'icon' => '', 'boss_id' => '13'),
            array('name' => 'Baiser de l\'araignée', 'rarity' => 'épique', 'type' => 'Bijou', 'icon' => '', 'boss_id' => '14'),
            array('name' => 'Lame en peine', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '14'),
            array('name' => 'Pendentif des noms oubliés', 'rarity' => 'épique', 'type' => 'Cou', 'icon' => '', 'boss_id' => '14'),
            array('name' => 'Croc de Maexxna', 'rarity' => 'épique', 'type' => 'À une main', 'icon' => '', 'boss_id' => '14'),
            array('name' => 'Robe de toile cristalline', 'rarity' => 'épique', 'type' => 'Torse', 'icon' => '', 'boss_id' => '14')
        );

        foreach($itemData as $item){
            DB::table('items')->insert([
                'name' => $item['name'],
                'rarity' => $item['rarity'],
                'type' => $item['type'],
                'icon' => '',
                'boss_id' => $item['boss_id']
            ]);              
        } 
    }
}

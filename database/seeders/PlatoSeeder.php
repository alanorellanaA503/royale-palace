<?php
namespace Database\Seeders;

use App\Models\Plato;
use App\Models\Sede;
use App\Models\Categoria;
use Illuminate\Database\Seeder;

class PlatoSeeder extends Seeder
{
    public function run(): void
    {
        $santaAna    = Sede::where('slug', 'santa-ana')->first();
        $sanSalvador = Sede::where('slug', 'san-salvador')->first();
        $sanMiguel   = Sede::where('slug', 'san-miguel')->first();

        $catAlmuerzo = Categoria::where('nombre', 'Almuerzos')->first();
        $catBebida   = Categoria::where('nombre', 'Bebidas')->first();
        $catEntrada  = Categoria::where('nombre', 'Entradas')->first();
        $catCena     = Categoria::where('nombre', 'Cenas')->first();

        // ── OCCIDENTE — Santa Ana ────────────────────────────
        $platosOcc = [
            ['nombre' => 'Pupusa Royale de Occidente',
             'descripcion' => 'Pupusa artesanal rellena de quesillo ahumado y chicharrón premium, acompañada de curtido fermentado lentamente y salsa de tomate rostizado.',
             'precio' => 8.50, 'categoria_id' => $catAlmuerzo->id],
            ['nombre' => 'Yuca Imperial',
             'descripcion' => 'Yuca frita en aceite de ajo, servida con chicharrón crocante, encurtidos de la casa y reducción de tomate especiado.',
             'precio' => 9.00, 'categoria_id' => $catAlmuerzo->id],
            ['nombre' => 'Tamal de Elote Dorado',
             'descripcion' => 'Tamal de elote tierno cocido al vapor, acompañado de crema fresca artesanal y queso de la región occidental.',
             'precio' => 6.50, 'categoria_id' => $catEntrada->id],
            ['nombre' => 'Costilla Santa Ana',
             'descripcion' => 'Costilla de cerdo marinada durante 24 horas en especias salvadoreñas y cocida lentamente hasta alcanzar una textura suave y jugosa.',
             'precio' => 14.00, 'categoria_id' => $catCena->id],
            ['nombre' => 'Mariscada Sonsonate Premium',
             'descripcion' => 'Selección de mariscos frescos del litoral occidental servidos en caldo aromático de coco y especias.',
             'precio' => 18.00, 'categoria_id' => $catAlmuerzo->id],
        ];

        foreach ($platosOcc as $p) {
            Plato::create(array_merge($p, ['sede_id' => $santaAna->id, 'disponible' => true]));
        }

        $bebidasOcc = [
            ['nombre' => 'Horchata Royale',
             'descripcion' => 'Receta tradicional enriquecida con canela de Ceilán y almendra tostada.',
             'precio' => 3.00, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Atol de Elote Gourmet',
             'descripcion' => 'Preparado con maíz tierno seleccionado y notas de vainilla natural.',
             'precio' => 3.50, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Café Volcán de Santa Ana',
             'descripcion' => 'Café de altura servido mediante método de extracción artesanal.',
             'precio' => 4.00, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Fresco de Marañón Reserva',
             'descripcion' => 'Elaborado con marañón fresco y un ligero toque cítrico.',
             'precio' => 3.00, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Chocolate Occidental',
             'descripcion' => 'Chocolate caliente preparado con cacao salvadoreño premium.',
             'precio' => 3.50, 'categoria_id' => $catBebida->id],
        ];

        foreach ($bebidasOcc as $b) {
            Plato::create(array_merge($b, ['sede_id' => $santaAna->id, 'disponible' => true]));
        }

        // ── CENTRO — San Salvador ────────────────────────────
        $platosCen = [
            ['nombre' => 'Pupusa Capital Royale',
             'descripcion' => 'Selección de mini pupusas gourmet con rellenos exclusivos y presentación degustación.',
             'precio' => 12.00, 'categoria_id' => $catAlmuerzo->id],
            ['nombre' => 'Filete Costero del Pacífico',
             'descripcion' => 'Pescado fresco acompañado de vegetales asados y salsa de limón y hierbas.',
             'precio' => 16.00, 'categoria_id' => $catCena->id],
            ['nombre' => 'Pollo de la Capital',
             'descripcion' => 'Pechuga de pollo marinada en especias salvadoreñas y servida con puré de plátano maduro.',
             'precio' => 13.00, 'categoria_id' => $catAlmuerzo->id],
            ['nombre' => 'Tabla Cuscatleca',
             'descripcion' => 'Degustación de quesos, embutidos artesanales y acompañamientos tradicionales.',
             'precio' => 15.00, 'categoria_id' => $catEntrada->id],
            ['nombre' => 'Cazuela del Centro',
             'descripcion' => 'Versión gourmet de la tradicional sopa de res con vegetales seleccionados.',
             'precio' => 11.00, 'categoria_id' => $catAlmuerzo->id],
        ];

        foreach ($platosCen as $p) {
            Plato::create(array_merge($p, ['sede_id' => $sanSalvador->id, 'disponible' => true]));
        }

        $bebidasCen = [
            ['nombre' => 'Café Especial San Salvador',
             'descripcion' => 'Café premium de altura servido en presentación de especialidad.',
             'precio' => 4.50, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Limonada Royale',
             'descripcion' => 'Limones frescos con hierbabuena y toque de miel artesanal.',
             'precio' => 3.00, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Fresco de Tamarindo Reserva',
             'descripcion' => 'Preparado con tamarindo natural y especias suaves.',
             'precio' => 2.50, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Atol Shuco Signature',
             'descripcion' => 'Inspirado en la receta tradicional con una presentación moderna.',
             'precio' => 3.00, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Té Frío Tropical',
             'descripcion' => 'Infusión de frutas nacionales servida fría.',
             'precio' => 3.00, 'categoria_id' => $catBebida->id],
        ];

        foreach ($bebidasCen as $b) {
            Plato::create(array_merge($b, ['sede_id' => $sanSalvador->id, 'disponible' => true]));
        }

        // ── ORIENTE — San Miguel ─────────────────────────────
        $platosOri = [
            ['nombre' => 'Pupusa Oriental Signature',
             'descripcion' => 'Pupusas artesanales acompañadas de curtido tradicional, mayonesa de la casa y salsa negra artesanal.',
             'precio' => 8.50, 'categoria_id' => $catAlmuerzo->id],
            ['nombre' => 'Carne Asada Migueleña Royale',
             'descripcion' => 'Corte premium de res servido con chimol fresco y guarniciones regionales.',
             'precio' => 17.00, 'categoria_id' => $catCena->id],
            ['nombre' => 'Mariscada Bahía de La Unión',
             'descripcion' => 'Selección de camarones, pescado y moluscos frescos del Golfo de Fonseca.',
             'precio' => 19.00, 'categoria_id' => $catAlmuerzo->id],
            ['nombre' => 'Sopa Marinera Imperial',
             'descripcion' => 'Caldo de mariscos elaborado lentamente con especias orientales.',
             'precio' => 14.00, 'categoria_id' => $catAlmuerzo->id],
            ['nombre' => 'Chanfaina Premium',
             'descripcion' => 'Interpretación elegante del tradicional platillo oriental, conservando sus sabores auténticos.',
             'precio' => 12.00, 'categoria_id' => $catCena->id],
        ];

        foreach ($platosOri as $p) {
            Plato::create(array_merge($p, ['sede_id' => $sanMiguel->id, 'disponible' => true]));
        }

        $bebidasOri = [
            ['nombre' => 'Fresco de Ensalada Oriental',
             'descripcion' => 'Bebida tradicional de frutas finamente cortadas y servida fría.',
             'precio' => 2.50, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Tamarindo Imperial',
             'descripcion' => 'Versión premium del clásico refresco oriental.',
             'precio' => 2.50, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Horchata Migueleña',
             'descripcion' => 'Con una mezcla especial de semillas y especias.',
             'precio' => 3.00, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Fresco de Jocote Corona',
             'descripcion' => 'Preparado con jocote fresco de temporada.',
             'precio' => 2.50, 'categoria_id' => $catBebida->id],
            ['nombre' => 'Café de Morazán',
             'descripcion' => 'Café artesanal de montaña servido en métodos filtrados.',
             'precio' => 4.00, 'categoria_id' => $catBebida->id],
        ];

        foreach ($bebidasOri as $b) {
            Plato::create(array_merge($b, ['sede_id' => $sanMiguel->id, 'disponible' => true]));
        }

        // ── PLATILLO INSIGNIA — Las 3 sedes ─────────────────
        foreach (Sede::all() as $sede) {
            Plato::create([
                'sede_id'      => $sede->id,
                'categoria_id' => $catAlmuerzo->id,
                'nombre'       => 'Royal Cuscatlán',
                'descripcion'  => 'Un homenaje a la riqueza culinaria salvadoreña. Combina ingredientes emblemáticos de Occidente, Centro y Oriente en una experiencia gastronómica elegante.',
                'precio'       => 24.00,
                'disponible'   => true,
                'es_insignia'  => true,
            ]);
        }
    }
}
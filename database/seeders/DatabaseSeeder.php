<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Categories
        $facial = Category::create([
            'name' => 'Cuidado Facial',
            'slug' => 'cuidado-facial',
            'description' => 'Tratamientos e hidratantes de lujo para el rostro formulados con extractos botánicos y activos puros.',
            'image_path' => 'facial.jpg'
        ]);

        $corporal = Category::create([
            'name' => 'Cuidado Corporal',
            'slug' => 'cuidado-corporal',
            'description' => 'Nutrición intensa y reafirmación para tu cuerpo con mantecas naturales y aceites esenciales aromáticos.',
            'image_path' => 'corporal.jpg'
        ]);

        $jabones = Category::create([
            'name' => 'Jabones Artesanales',
            'slug' => 'jabones-artesanales',
            'description' => 'Jabones saponificados en frío que limpian con suavidad, enriquecidos con arcillas y aceites nutritivos.',
            'image_path' => 'jabones.jpg'
        ]);

        $serums = Category::create([
            'name' => 'Sérums & Aceites',
            'slug' => 'serums-aceites',
            'description' => 'Fórmulas altamente concentradas que penetran profundamente para tratar necesidades específicas de la piel.',
            'image_path' => 'serums.jpg'
        ]);

        // 2. Create Products

        // Cuidado Facial Products
        Product::create([
            'category_id' => $facial->id,
            'name' => 'Crema Facial de Rosas y Argán',
            'slug' => 'crema-facial-rosas-argan',
            'description' => 'Nuestra crema hidratante estrella combina el poder regenerador del aceite de argán con el aroma reconfortante y las propiedades calmantes del absoluto de rosa damascena. Nutre profundamente, mejora la elasticidad de la piel y aporta una luminosidad radiante sin dejar sensación grasosa.',
            'ingredients' => 'Agua de Rosas Orgánica, Aceite de Argán Prensado en Frío, Ácido Hialurónico Vegetal, Manteca de Karité, Aceite Esencial de Rosa Damascena, Vitamina E.',
            'skin_type' => 'Seca y Mixta',
            'price' => 34.99,
            'stock' => 50,
            'image_path' => 'crema-rosas.jpg',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $facial->id,
            'name' => 'Exfoliante Facial de Café Orgánico',
            'slug' => 'exfoliante-facial-cafe',
            'description' => 'Formulado con granos finamente molidos de café arábica y aceites botánicos. Remueve las células muertas suavemente mientras estimula la microcirculación y reduce la hinchazón, dejando tu rostro suave, renovado y con un sutil aroma a café fresco.',
            'ingredients' => 'Café Arábica Molido Orgánico, Aceite de Almendras Dulces, Manteca de Coco, Azúcar de Caña Orgánica, Extracto de Vainilla, Aceite de Jojoba.',
            'skin_type' => 'Todo tipo de piel',
            'price' => 22.50,
            'stock' => 40,
            'image_path' => 'exfoliante-cafe.jpg',
            'is_featured' => false,
        ]);

        Product::create([
            'category_id' => $facial->id,
            'name' => 'Mascarilla de Arcilla Rosa Francesa',
            'slug' => 'mascarilla-arcilla-rosa',
            'description' => 'Mascarilla purificante ultra-suave diseñada para limpiar los poros y desintoxicar las pieles sensibles. Combina arcilla rosa francesa rica en minerales con extracto de manzanilla para aliviar rojeces, suavizar la textura y revelar una piel visiblemente más fresca.',
            'ingredients' => 'Arcilla Rosa Francesa Kaolín, Polvo de Manzanilla Orgánica, Gel de Aloe Vera, Extracto de Caléndula, Hidrolato de Lavanda.',
            'skin_type' => 'Sensible y Delicada',
            'price' => 28.00,
            'stock' => 30,
            'image_path' => 'mascarilla-rosa.jpg',
            'is_featured' => true,
        ]);

        // Cuidado Corporal Products
        Product::create([
            'category_id' => $corporal->id,
            'name' => 'Manteca Corporal Reafirmante de Cacao',
            'slug' => 'manteca-corporal-cacao',
            'description' => 'Una rica y cremosa manteca corporal que se funde con la temperatura de la piel. Enriquecida con manteca de cacao pura y aceite de almendras, proporciona una hidratación profunda de larga duración y mejora la firmeza y elasticidad, previniendo estrías y resequedad.',
            'ingredients' => 'Manteca de Cacao Pura, Manteca de Karité, Aceite de Almendras Dulces, Aceite de Coco, Vitamina E, Aceite Esencial de Naranja Dulce.',
            'skin_type' => 'Seca y Muy Seca',
            'price' => 29.99,
            'stock' => 60,
            'image_path' => 'manteca-cacao.jpg',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $corporal->id,
            'name' => 'Bálsamo Corporal de Caléndula & Lavanda',
            'slug' => 'balsamo-calendula-lavanda',
            'description' => 'Formulado especialmente para calmar y reparar zonas ásperas o irritadas del cuerpo (codos, rodillas, talones). La caléndula aporta propiedades cicatrizantes y reparadoras, mientras que la lavanda ayuda a relajar el cuerpo y los sentidos antes de dormir.',
            'ingredients' => 'Extracto de Caléndula Orgánica, Cera de Abejas de Cooperativa, Aceite de Oliva Extra Virgen, Aceite Esencial de Lavanda Angustifolia, Aceite de Germen de Trigo.',
            'skin_type' => 'Seca e Irritada',
            'price' => 18.90,
            'stock' => 45,
            'image_path' => 'balsamo-calendula.jpg',
            'is_featured' => false,
        ]);

        // Jabones Artesanales Products
        Product::create([
            'category_id' => $jabones->id,
            'name' => 'Jabón Orgánico de Lavanda y Avena',
            'slug' => 'jabon-lavanda-avena',
            'description' => 'Hecho a mano mediante el proceso tradicional en frío. La avena coloidal exfolia sutilmente y equilibra el pH, mientras que la lavanda calma la piel y calma la mente. Un básico suave y cremoso ideal para toda la familia y pieles con tendencia a eczema.',
            'ingredients' => 'Aceite de Oliva Saponificado, Aceite de Coco Saponificado, Avena Coloidal Molida, Flores de Lavanda Orgánica, Aceite Esencial de Lavanda.',
            'skin_type' => 'Sensible, Seca e Infantil',
            'price' => 8.50,
            'stock' => 120,
            'image_path' => 'jabon-lavanda.jpg',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $jabones->id,
            'name' => 'Jabón de Carbón Activado y Menta',
            'slug' => 'jabon-carbon-activado-menta',
            'description' => 'Un jabón de limpieza profunda y efecto desintoxicante. El carbón activado atrae y absorbe el exceso de grasa, impurezas y toxinas de los poros, mientras que la menta piperita refresca y tonifica la piel de forma instantánea. Ideal para el rostro y cuerpo.',
            'ingredients' => 'Aceite de Oliva y Coco Saponificados, Carbón Activado de Cáscara de Coco, Aceite Esencial de Menta Piperita, Aceite Esencial de Árbol de Té.',
            'skin_type' => 'Grasa y Acneica',
            'price' => 9.00,
            'stock' => 100,
            'image_path' => 'jabon-carbon.jpg',
            'is_featured' => false,
        ]);

        Product::create([
            'category_id' => $jabones->id,
            'name' => 'Jabón Cremoso de Coco y Albaricoque',
            'slug' => 'jabon-coco-albaricoque',
            'description' => 'Jabón rico y espumoso enriquecido con leche de coco para nutrir e hidratar. Contiene semillas de albaricoque finamente molidas para una exfoliación corporal diaria agradable que elimina células muertas y estimula la renovación celular de la piel.',
            'ingredients' => 'Aceite de Coco Saponificado, Manteca de Karité Saponificada, Leche de Coco Orgánica, Semillas de Albaricoque Molidas, Esencia Natural de Coco.',
            'skin_type' => 'Todo tipo de piel',
            'price' => 8.50,
            'stock' => 110,
            'image_path' => 'jabon-coco.jpg',
            'is_featured' => false,
        ]);

        // Sérums & Aceites Products
        Product::create([
            'category_id' => $serums->id,
            'name' => 'Sérum Iluminador de Vitamina C & Ácido Ferúlico',
            'slug' => 'serum-vitamina-c',
            'description' => 'Un potente elíxir antioxidante que combate las manchas, unifica el tono de la piel y promueve la síntesis de colágeno. Con un 15% de vitamina C estable enriquecida con ácido ferúlico y extracto de té verde, protege la piel del envejecimiento prematuro y el estrés ambiental.',
            'ingredients' => 'Vitamina C Estable (Sodium Ascorbyl Phosphate) 15%, Ácido Ferúlico 1%, Ácido Hialurónico de Triple Peso Molecular, Extracto de Té Verde, Pantenol.',
            'skin_type' => 'Todo tipo de piel (Opacidad, Manchas)',
            'price' => 42.00,
            'stock' => 35,
            'image_path' => 'serum-vitamina-c.jpg',
            'is_featured' => true,
        ]);

        Product::create([
            'category_id' => $serums->id,
            'name' => 'Aceite Facial de Elíxir de Bakuchiol y Escualano',
            'slug' => 'aceite-bakuchiol-escualano',
            'description' => 'Considerado la alternativa vegetal al retinol, el Bakuchiol ofrece todos los beneficios antiedad del retinol (reducción de líneas de expresión, renovación celular, firmeza) pero sin irritación ni fotosensibilidad. Diluido en escualano de oliva pura para una absorción aterciopelada.',
            'ingredients' => 'Escualano de Oliva Puro, Bakuchiol Concentrado 2%, Aceite de Semilla de Rosa Mosqueta Orgánica, Coenzima Q10, Aceite de Jojoba, Extracto de Romero.',
            'skin_type' => 'Madura, Seca o Sensible',
            'price' => 49.00,
            'stock' => 25,
            'image_path' => 'aceite-bakuchiol.jpg',
            'is_featured' => true,
        ]);
    }
}

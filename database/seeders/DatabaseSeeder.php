<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario admin
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@techstock.com',
            'password' => bcrypt('admin123'),
            'avatar' => null,
        ]);

        // Categorías
        $laptops = Category::create(['name' => 'Laptops', 'description' => 'Computadoras portátiles']);
        $accesorios = Category::create(['name' => 'Accesorios', 'description' => 'Periféricos y complementos']);
        $monitores = Category::create(['name' => 'Monitores', 'description' => 'Pantallas y displays']);
        $almacenamiento = Category::create(['name' => 'Almacenamiento', 'description' => 'Discos duros y memorias']);
        $redes = Category::create(['name' => 'Redes', 'description' => 'Equipos de conectividad']);

        // Proveedores
        $logitech = Supplier::create(['name' => 'Logitech', 'email' => 'ventas@logitech.com', 'phone' => '972345621', 'address' => 'Av. Tecnología 456']);
        $kingston = Supplier::create(['name' => 'Kingston', 'email' => 'info@kingston.com', 'phone' => '981234567', 'address' => 'Jr. Memoria 123']);
        $acer = Supplier::create(['name' => 'Acer', 'email' => 'soporte@acer.com', 'phone' => '999888777', 'address' => 'Av. Principal 789']);
        $samsung = Supplier::create(['name' => 'Samsung', 'email' => 'ventas@samsung.com', 'phone' => '911222333', 'address' => 'Av. Digital 555']);
        $tpLink = Supplier::create(['name' => 'TP-Link', 'email' => 'soporte@tplink.com', 'phone' => '944556677', 'address' => 'Jr. Redes 222']);

        // 15 Productos
        Product::create(['category_id'=>$laptops->id,'supplier_id'=>$acer->id,'sku'=>'LAP-001','name'=>'Laptop HP 15" Core i5','price'=>2500.00,'stock'=>12,'min_stock'=>5,'description'=>'Laptop HP Core i5 8GB RAM 512GB SSD']);
        Product::create(['category_id'=>$laptops->id,'supplier_id'=>$acer->id,'sku'=>'LAP-002','name'=>'Laptop Dell Inspiron 14','price'=>2800.00,'stock'=>8,'min_stock'=>4,'description'=>'Dell Inspiron 14" Ryzen 5']);
        Product::create(['category_id'=>$laptops->id,'supplier_id'=>$acer->id,'sku'=>'LAP-003','name'=>'Laptop Lenovo ThinkPad','price'=>3200.00,'stock'=>3,'min_stock'=>5,'description'=>'ThinkPad E14 empresarial']);
        
        Product::create(['category_id'=>$accesorios->id,'supplier_id'=>$logitech->id,'sku'=>'TEC-001','name'=>'Teclado Mecánico RGB','price'=>250.00,'stock'=>20,'min_stock'=>10,'description'=>'Teclado gamer mecánico switches azules']);
        Product::create(['category_id'=>$accesorios->id,'supplier_id'=>$logitech->id,'sku'=>'MOU-001','name'=>'Mouse Logitech G502','price'=>180.00,'stock'=>15,'min_stock'=>8,'description'=>'Mouse gamer 16000 DPI']);
        Product::create(['category_id'=>$accesorios->id,'supplier_id'=>$logitech->id,'sku'=>'AUD-001','name'=>'Audífonos HyperX Cloud','price'=>320.00,'stock'=>2,'min_stock'=>5,'description'=>'Audífonos gamer con micrófono']);
        Product::create(['category_id'=>$accesorios->id,'supplier_id'=>$logitech->id,'sku'=>'WEBCAM-001','name'=>'Webcam Logitech C920','price'=>290.00,'stock'=>7,'min_stock'=>5,'description'=>'Webcam Full HD 1080p']);
        
        Product::create(['category_id'=>$monitores->id,'supplier_id'=>$samsung->id,'sku'=>'MON-001','name'=>'Monitor Samsung 24" 144Hz','price'=>800.00,'stock'=>2,'min_stock'=>4,'description'=>'Monitor gaming 1ms respuesta']);
        Product::create(['category_id'=>$monitores->id,'supplier_id'=>$samsung->id,'sku'=>'MON-002','name'=>'Monitor LG 27" 4K','price'=>1200.00,'stock'=>5,'min_stock'=>3,'description'=>'Monitor profesional 4K UHD']);
        Product::create(['category_id'=>$monitores->id,'supplier_id'=>$samsung->id,'sku'=>'MON-003','name'=>'Monitor Curvo 32"','price'=>1500.00,'stock'=>4,'min_stock'=>2,'description'=>'Monitor curvo gaming 165Hz']);
        
        Product::create(['category_id'=>$almacenamiento->id,'supplier_id'=>$kingston->id,'sku'=>'MEM-001','name'=>'Memoria RAM 8GB DDR4','price'=>150.00,'stock'=>3,'min_stock'=>5,'description'=>'Memoria RAM Kingston Fury 3200MHz']);
        Product::create(['category_id'=>$almacenamiento->id,'supplier_id'=>$kingston->id,'sku'=>'MEM-002','name'=>'Memoria RAM 16GB DDR4','price'=>280.00,'stock'=>10,'min_stock'=>5,'description'=>'Memoria RAM 16GB 3600MHz']);
        Product::create(['category_id'=>$almacenamiento->id,'supplier_id'=>$kingston->id,'sku'=>'SSD-001','name'=>'SSD Kingston 480GB','price'=>220.00,'stock'=>18,'min_stock'=>8,'description'=>'SSD SATA 2.5" 480GB']);
        Product::create(['category_id'=>$almacenamiento->id,'supplier_id'=>$kingston->id,'sku'=>'SSD-002','name'=>'SSD NVMe 1TB','price'=>450.00,'stock'=>6,'min_stock'=>4,'description'=>'SSD M.2 NVMe Gen4 1TB']);
        
        Product::create(['category_id'=>$redes->id,'supplier_id'=>$tpLink->id,'sku'=>'RUT-001','name'=>'Router TP-Link AX3000','price'=>380.00,'stock'=>9,'min_stock'=>5,'description'=>'Router WiFi 6 dual band']);
        Product::create(['category_id'=>$redes->id,'supplier_id'=>$tpLink->id,'sku'=>'SWI-001','name'=>'Switch 8 puertos Gigabit','price'=>180.00,'stock'=>1,'min_stock'=>3,'description'=>'Switch no administrable 8 ports']);
    }
}
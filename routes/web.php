<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request; //esta es para poder capturar los datos que se envian por el formulario.

use App\Models\Product; //este es el modelo de la tabla products ubicado en ruta app/Models


//esta ruta principal es para la autentificación
Route::middleware('auth')->group(function(){

    Route::get(' ', function(){
        return redirect()->route('products.index');
        })->name('inicio');

    //aquí creamos las diferentes rutas para acceder por la web,
   //las view son todo el HTML
   Route::get('products', function(){
    //    $products = Product::all();
        $products = Product::orderby('created_at', 'desc')->get();
        return view('products.index', compact('products'));
    })->name('products.index');
    
    
    Route::get('products/create', function(){
        return view('products.create' );
    })->name('products.create');
    
    
    //con esta ruta estamos guardando en la base de datos tabla product
    Route::post('products', function(Request $request){
        $newProduct = new Product;
        $newProduct->description = $request->input('description');
        $newProduct->price = $request->input('price');
        $newProduct->save();
    
        return redirect()->route('products.index')->with('info','Producto creado exitosamente');
    })->name('products.store');
    
    //para eliminar los registros
    Route::delete('products/{id}', function($id){
      $product = Product::findOrFail($id);
      $product->delete();
      return redirect()->route('products.index')->with('info','Producto eliminado exitosamente');
    })->name('products.destroy');
    
    //Para editar producto
    Route::get('products/{id}', function($id){
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    })->name('products.edit');
    
    //
    Route::put('/products/{id}', function(Request $request, $id){
        $product = Product::findOrFail($id);
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->save();
        return redirect()->route('products.index')->with('info','Producto actualizado exitosamente');
    })->name('products.update');

});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

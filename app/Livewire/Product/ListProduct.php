<?php

namespace App\Livewire\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class ListProduct extends Component
{
    use WithFileUploads;

    public $products;
    public $name;
    public $barcode;
    public $selling_price;
    public $grocery_price;
    public $quantity;
    public $description;
    public $image;
    public $isUploading = false; 

    public function mount()
    {
        $this->products = Product::all();
    }

    public function createProduct()
    {
        $this->quantity = 0;

        $validatedData = $this->validate([
            'name' => 'required',
            'description' => 'nullable',
            'barcode' => 'nullable',
            'selling_price' => 'nullable|numeric|min:0',
            'grocery_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|max:1024', // Assuming max file size is 1MB
        ], [
            'name.required' => 'The name field is required.',
            'image.image' => 'The image must be an image file.',
            'image.max' => 'The image size must be less than 1MB.',
            'selling_price.numeric' => 'The selling price must be a number.',
            'selling_price.min' => 'The selling price must be at least 0.',
            'grocery_price.numeric' => 'The grocery price must be a number.',
            'grocery_price.min' => 'The grocery price must be at least 0.',
        ]);

        // Generate a unique filename for the image
        $imageName = md5(uniqid() . time()) . '.' . $this->image->getClientOriginalExtension();

        // Store the uploaded image in the storage/app/public directory
        $this->image->storeAs('public/product', $imageName);

        // Create the product with the validated data and image path
        Product::create([
            'name' => $this->name,
            'barcode' => $this->barcode,
            'quantity' => $this->quantity,
            'description' => $this->description,
            'selling_price' => $this->selling_price,
            'grocery_price' => $this->grocery_price,
            'image' => 'product/' . $imageName,
        ]);

        $productName = $this->name; // Assuming 'name' is the field for the product name
        Session::flash('success', $productName);

        // Reset form fields after saving
        $this->reset([
            'name', 'barcode', 'selling_price', 'grocery_price', 'quantity', 'description', 'image', 'isUploading'
        ]);
        
        // Refresh the product list after creating a new product
        $this->refreshComponent();
        
    }

    public function deleteProduct($productId)
    {
        // Find the product by ID
        $product = Product::findOrFail($productId);

        // Delete the product
        $product->delete();

        // Refresh the product list after deletion
        $this->refreshComponent();
    }
    
    
    public function refreshComponent()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        $products = Product::all();

        return view('livewire.product.list-product', compact('products'));
    }
    

}

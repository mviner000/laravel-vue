<div>
    <div>
        @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('success') }}</strong> has been successfully added.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form wire:submit.prevent="createProduct">
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" wire:model="name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3">
                <label for="barcode">Barcode</label>
                <input type="text" class="form-control" id="barcode" wire:model="barcode">
                @error('barcode') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3">
                <label for="quantity">Quantity</label>
                <input type="number" class="form-control" id="quantity" wire:model="quantity">
                @error('quantity') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="grocery_price" class="form-label">Grocery Price</label>
                        <input wire:model.defer="grocery_price" type="number" class="form-control" id="grocery_price">
                        @error('grocery_price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="selling_price" class="form-label">Selling Price</label>
                        <input wire:model.defer="selling_price" type="number" class="form-control" id="selling_price">
                        @error('selling_price') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
            
            <div class="mb-3">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" wire:model="description"></textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <div class="mb-3">
                <label for="image">Image</label>
                <!-- Disable the input while image is uploading -->
                <input type="file" class="form-control" id="image" wire:model="image" @if($isUploading) disabled @endif>
                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            
            <!-- Disable submit button while image is uploading -->
            <button type="submit" class="btn btn-primary" @if($isUploading) disabled @endif>Save Product</button>
        </form>
    </div>
    


    <div>
        @if($products)
            <div>
                <h1>Products</h1>
            
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Barcode</th>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Selling Price</th>
                            <th>Grocery Price</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id ?? 'null' }}</td>
                                <td>{{ $product->barcode ?? 'null' }}</td>
                                <td>{{ $product->name ?? 'null' }}</td>
                                <td>{{ $product->quantity ?? 'null' }}</td>
                                <td>{{ $product->selling_price ?? 'null' }}</td>
                                <td>{{ $product->grocery_price ?? 'null' }}</td>
                                <td>{{ $product->description ?? 'null' }}</td>
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                                    @else
                                        null
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="deleteProduct('{{ $product->id }}')" class="btn btn-danger">Delete</button>
                                </td>                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        @else
            <p>No products found.</p>
        @endif
    </div>
    
    
</div>

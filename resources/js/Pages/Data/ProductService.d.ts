declare module './ProductService' {
    const ProductService: {
        getProductsData(): any[];
        getProductsMini(): Promise<any[]>;
        getProductsSmall(): Promise<any[]>;
        getProducts(): Promise<any[]>;
    };

    export default ProductService;
}
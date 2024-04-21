// Ensure the file is treated as a module
export {};

// Augment the existing CustomerService module
declare module './CustomerService' {
    const CustomerService: {
        getCustomersSmall(): Promise<any[]>;
        getCustomersMedium(): Promise<any[]>;
        getCustomersLarge(): Promise<any[]>;
        getCustomersXLarge(): Promise<any[]>;
        getCustomers(params?: Record<string, any>): Promise<any[]>;
    }
    export default CustomerService;
}

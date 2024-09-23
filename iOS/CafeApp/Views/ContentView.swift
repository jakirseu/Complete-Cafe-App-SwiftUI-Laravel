import SwiftUI

struct ContentView: View {
    @EnvironmentObject private var cart: CartManager
    
    // Change Product and Category URL.
    @StateObject private var productManager = DataManager<Product>(baseURL: "http://commerceapp.test/api/product")
    @StateObject private var categoryManager = DataManager<Category>(baseURL: "http://commerceapp.test/api/category")
    
    @State private var selectedCategory: Category? = nil
    
    private let columns = [
        GridItem(.adaptive(minimum: 160))
    ]
    
    var body: some View {
        NavigationStack {
            
            ZStack {
                Color(.systemGray6)
                    .ignoresSafeArea()
                
                VStack{
                    ScrollView(.horizontal){
                        HStack {
                            Button(action: {
                                selectedCategory = nil // Set to nil to show all products
                            }) {
                                Text("All")
                                    .padding()
                                    .background(selectedCategory == nil ? Color.blue : Color.gray.opacity(0.2))
                                    .foregroundColor(selectedCategory == nil ? Color.white : Color.black)
                                    .cornerRadius(8)
                            }
                            .buttonStyle(PlainButtonStyle())
                            
                            ForEach(categoryManager.items) { category in
                                Button(action: {
                                    selectedCategory = category
                                }) {
                                    Text(category.name) // Assuming Category has a 'name' property
                                        .padding()
                                        .background(selectedCategory == category ? Color.blue : Color.gray.opacity(0.2))
                                        .foregroundColor(selectedCategory == category ? Color.white : Color.black)
                                        .cornerRadius(8)
                                }
                                .buttonStyle(PlainButtonStyle()) // To remove default button styles
                            }
                        }
                    }
                    .padding()
                    
                    ScrollView {
                        if productManager.isLoading {
                            ProgressView("Loading products...")
                        } else if let errorMessage = productManager.errorMessage {
                            
                            Text("Error: \(errorMessage)")
                        } else {
                            LazyVGrid(columns: columns, spacing: 20) {
                                ForEach(filteredProducts) { product in
                                    NavigationLink(destination: ProductDetails(product: product)) {
                                        ProductGrid(product: product)
                                    }
                                    
                                }
                            }
                            .padding()
                        }
                    }
                }
                .navigationTitle("Urban Cafe")
                .navigationBarTitleDisplayMode(.inline)
                .task {
                    await productManager.fetchItems()
                    await categoryManager.fetchItems()
                }
                
                
                .toolbar {
                    ToolbarItemGroup(placement: .navigationBarTrailing) {
                        ToolbarCartCount()
                    }
                }
            }
        }
    }
    
    // Computed property to filter products based on the selected category
    private var filteredProducts: [Product] {
        guard let selectedCategory = selectedCategory else {
            return productManager.items // Return all products if no category is selected
        }
        
        // Add your filtering logic based on the selected category
        return productManager.items.filter { $0.category == selectedCategory.name } // Assuming Product has a 'categoryID' property
    }
}

#Preview {
    ContentView()
        .environmentObject(CartManager())
}

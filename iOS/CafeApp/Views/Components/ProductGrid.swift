import Foundation
import SwiftUI


struct ProductGrid: View {
    @EnvironmentObject private var cart: CartManager
    let product: Product
    
    var body: some View {
        VStack{
            
            ImageVIew(imageURL: product.image)
            
                Text(product.title)
                    .font(.headline)
                    .lineLimit(1)
      
            HStack (spacing: 2) {
                Text("$\(product.price, specifier: "%.2f")")
        
                Spacer()
                Button {
                    cart.addToCart(product)
                } label: {
                    Label("Add", systemImage: "cart")
                        .foregroundStyle(.blue)
                }
            }
    }
        .frame(width: 150)
        .padding()
        .background(Color.white)
        .foregroundStyle(.black)
        .cornerRadius(20.0)
        
        
    }
}
#Preview {
    ProductGrid(product: Product(id: 1, title: "Sample Product", price: 120.00, description: "This is a sample Product.", category: "Main", image: "https://placehold.co/400x400/000000/FFFFFF/png"))
        .environmentObject(CartManager())
}



import SwiftUI

struct CartView: View {
    @EnvironmentObject private var cart: CartManager
    
    @ObservedObject var model = PaymentManager()
    
    var body: some View {
        NavigationStack{
        ScrollView {
            if cart.cartCount > 0 {
                ForEach(cart.cartItems.sorted(by: { $0.key.id < $1.key.id }), id: \.key) { product, key in
                    HStack {
                        
                        VStack(alignment: .leading){
                            Text(product.title)
                                .font(.title3)
                            Text("Price: " + String(format: "%.2f", product.price))
                                .font(.callout)
                        }
                        Spacer()
                        Button(action: {
                            cart.addToCart(product)
                        }, label: {
                            Image(systemName: "plus")
                        })
                        
                        Button(action: {
                            cart.removeFromCart(product: product)
                        }, label: {
                            Image(systemName: "minus")
                        })
                        
                        Text("\(key)")
                            .font(.title)
                            .bold()
                    }
                    .padding()
                }
                NavigationLink {
                    CheckoutView()
                } label: {
                    Text("Proceed to checkout")
                        .padding()
                        .foregroundStyle(.white)
                        .background(.blue)
                        .clipShape(Capsule())
                }
                
            } else{
                Text("Your cart is empty. Go back and add some products!")
            }
        }
        .padding(10)
        .navigationTitle("Cart Review")
    }
    }
}



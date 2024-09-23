import SwiftUI

struct ProductDetails: View {
    @EnvironmentObject private var cart: CartManager
    let product: Product
    @State var count = 1
    
    
    var body: some View {
        ZStack {
            Color(.systemGray6)
            ScrollView  {

                ImageVIew(imageURL: product.image)
                
                VStack (alignment: .leading) {
                    Text(product.title)
                        .font(.title)
                        .fontWeight(.bold)
                    
                    
                    Text("Description")
                        .fontWeight(.medium)
                        .padding(.vertical, 8)
                    Text(product.description ?? "")
                        .lineSpacing(8.0)
                        .opacity(0.6)
                    
                    // Counter
                        HStack {
                            Spacer()
                            Button(action: {
                                
                                count = max(count - 1, 1)
                            }) {
                                Image(systemName: "minus.circle")
                                    .foregroundColor(.gray)
                                    .font(.title)
           
                            }
       
                            Text("\(count)")
                                .font(.title2)
                                .fontWeight(.semibold)
                                .padding(.horizontal, 8)

                            Button(action: {
                                count += 1
                            }) {
                                Image(systemName: "plus.circle.fill")
                                    .foregroundColor(.yellow)
                                    .font(.title)
                                     
                            }
                        }
                        .padding()
                }
                .padding()
                .padding(.top)
                .padding(.bottom, 80)
                .background(Color(.systemGray6))
                .clipShape(
                    UnevenRoundedRectangle(cornerRadii:.init(
                        topLeading: 40.0,
                        bottomLeading: 0.0,
                        bottomTrailing: 0.0,
                        topTrailing: 40.0)))
                .offset(x: 0, y: -30.0)
            }
            
            
            
            // Bottom Add to Cart Button
            HStack {
                Text("$\(product.price, specifier: "%.2f")")
                    .font(.title)
                    .foregroundColor(.white)
                Spacer()
                
                Button(action: {
                    cart.addToCart(product, count: count)
                }, label: {
                    Text("Add to Cart")
                        .font(.title3)
                        .fontWeight(.semibold)
                        .foregroundColor(.yellow)
                        .padding()
                        .padding(.horizontal, 8)
                        .background(Color.white)
                        .cornerRadius(10.0)
                })

            }
            .padding()
            .padding(.horizontal)
            .background(Color(.yellow))
            .clipShape(RoundedRectangle(cornerRadius: 30))
            .padding(.horizontal)
            .frame(maxHeight: .infinity, alignment: .bottom)
            
            .toolbar {
                ToolbarItemGroup(placement: .navigationBarTrailing) {
                    ToolbarCartCount()
                }
            }
            .navigationTitle(product.title)
        }
        
    }
}

#Preview {
    ProductDetails(product: Product(id: 1, title: "Sample Product", price: 120.00, description: "This is a sample Product.", category: "Main", image: "https://placehold.co/400x400/000000/FFFFFF/png"))
        .environmentObject(CartManager())
}

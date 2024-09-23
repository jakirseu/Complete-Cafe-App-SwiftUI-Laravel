

import SwiftUI

struct ToolbarCartCount: View {
    @EnvironmentObject private var cart: CartManager
    var body: some View {
        NavigationLink {
            CartView()
        } label: {
            
            ZStack(alignment: .topTrailing){
                Image(systemName: "cart")
                    .padding(.top, 5)
                
                if cart.cartCount > 0{
                    Text("\(cart.cartCount)")
                        .font(.caption2).bold()
                        .foregroundColor(.white)
                        .frame(width: 15, height: 15)
                        .background(.red)
                        .cornerRadius(50)
                    
                }
            }
        }
    }
}

#Preview {
    ToolbarCartCount()
        .environmentObject(CartManager())
}

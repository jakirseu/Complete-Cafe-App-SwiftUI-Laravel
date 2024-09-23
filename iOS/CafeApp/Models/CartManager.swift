import Foundation

class CartManager: ObservableObject {
    
    @Published var cartItems  =  [Product : Int]()
    
    var getTotalAmount: Double {
        var totalAmount = 0.0
        for (product, count) in cartItems {
            totalAmount += product.price * Double(count)
        }
        return totalAmount
    }
    
    var cartCount: Int {
        var totalCount = 0
        for (_, count) in cartItems {
            totalCount += count
        }
        return totalCount
    }
    
    func addToCart(_ product: Product, count: Int = 1) {
        if let currentCount = cartItems[product] {
            cartItems[product] = currentCount + count
        } else {
            cartItems[product] = count
        }
    }
    
    func removeFromCart(product: Product) {
        if let count = cartItems[product], count > 1 {
            cartItems[product] = count - 1
        } else {
            cartItems[product] = nil
        }
    }
}

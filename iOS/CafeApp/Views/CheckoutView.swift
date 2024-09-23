import SwiftUI
import StripePaymentSheet

struct CheckoutView: View {
    @EnvironmentObject private var cart: CartManager
    @ObservedObject var paymentManager = PaymentManager()
    
    @State var paymentComplete = false
    @State var errorMessage = ""
    
    var body: some View {
 
            ScrollView {
                
                ForEach(cart.cartItems.sorted(by: { $0.key.id < $1.key.id }), id: \.key) { product, key in
                    HStack {
                     
                        VStack(alignment: .leading){
                            Text(product.title)
                                .font(.title3)
                            Text("\(key) * \(product.price, specifier: "%.2f") ")
                                .font(.callout)
                        }
                        Spacer()
                        
                        Text(" = $ \(Double(key) * product.price, specifier: "%.2f")")
                            .font(.title)
                    }
                    .padding()
                }
                
                Divider()
                
                HStack{
                    Text("Total: ")
                    Text("\(String(format: "%.2f", cart.getTotalAmount))")
                }
                .font(.title)
                // checking is paymentSheet is ready to use.
                if let paymentSheet = paymentManager.paymentSheet {
                    PaymentSheet.PaymentButton(
                        paymentSheet: paymentSheet,
                        onCompletion: { result in
                            switch result {
                            case .completed:
                                paymentComplete = true
                                // reseting cart
                                cart.cartItems = [:]
                            case .canceled:
                                errorMessage = "Canceled transection. "
                            case .failed(error: let error):
                                errorMessage = "Payment failed: \(error.localizedDescription)"
                            }
                        }
                    ) {
                        Text("Place order!")
                            .padding()
                            .foregroundStyle(.white)
                            .background(.blue)
                            .clipShape(Capsule())
                        
                    }
                } else {
                    Text("Loading payment methods…")
                }
                
                Text(errorMessage)
                    .foregroundStyle(.red)
            }
            .padding(10)
            
            .navigationDestination(isPresented: $paymentComplete) {
                ThankYou()
            }
            .navigationTitle("Checkout")
      
        // fetching a PaymentIntent
        .onAppear { paymentManager.preparePaymentSheet(total: cart.getTotalAmount) }
        
        // reseting payment result so that errors will get reset
        .onDisappear(){
            paymentManager.paymentResult = nil
        }
    }
}



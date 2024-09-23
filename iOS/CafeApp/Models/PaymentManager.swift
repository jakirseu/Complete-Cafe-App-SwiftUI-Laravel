import Foundation
import StripePaymentSheet
 
// You can follow this tutorial to setup stripe. 
// https://devswiftly.com/complete-e-commerce-app-in-swiftui-with-stripe-apple-pay/

class PaymentManager: ObservableObject {
    // Your backend endpoint for generating payment sheet.
    // https://docs.stripe.com/payments/accept-a-payment?platform=ios
    let backendCheckoutUrl = URL(string: "https://yourdomain.com/payment-sheet")!
    
    @Published var paymentSheet: PaymentSheet?
    @Published var paymentResult: PaymentSheetResult?
    
    func preparePaymentSheet(total: Double) {

        // MARK: Fetch the PaymentIntent and Customer information from the backend
        var request = URLRequest(url: backendCheckoutUrl)
        request.httpMethod = "POST"
        
        request.setValue("application/json", forHTTPHeaderField: "Content-Type")
        // passing total payment to server
        request.httpBody = try! JSONSerialization.data(withJSONObject: ["total": total])
        
        let task = URLSession.shared.dataTask(with: request, completionHandler: { [weak self] (data, response, error) in
            guard let data = data,
                  let json = try? JSONSerialization.jsonObject(with: data, options: []) as? [String : Any],
                  let customerId = json["customer"] as? String,
                  let customerEphemeralKeySecret = json["ephemeralKey"] as? String,
                  let paymentIntentClientSecret = json["paymentIntent"] as? String,
                  let publishableKey = json["publishableKey"] as? String,
                  let self = self else {
                // Handle error
                return
            }
            
            STPAPIClient.shared.publishableKey = publishableKey
            // MARK: Create a PaymentSheet instance
            var configuration = PaymentSheet.Configuration()
            // Enabling Apple Pay
//            configuration.applePay = .init(
//              merchantId: "merchant.com.your_app_name",
//              merchantCountryCode: "US"
//            )
            
            configuration.merchantDisplayName = "Example, Inc."
            configuration.customer = .init(id: customerId, ephemeralKeySecret: customerEphemeralKeySecret)
            
            // Set `allowsDelayedPaymentMethods` to true if your business can handle payment methods
            // that complete payment after a delay, like SEPA Debit and Sofort.
            configuration.allowsDelayedPaymentMethods = true
            
            DispatchQueue.main.async {
                self.paymentSheet = PaymentSheet(paymentIntentClientSecret: paymentIntentClientSecret, configuration: configuration)
            }
        })
        task.resume()
    }
}

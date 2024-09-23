import SwiftUI

struct ThankYou: View {
    var body: some View {
        VStack{
            Text("😻")
                .font(.system(size: 100))
            Text("Thank you for your purchase! 🎉 We hope our products will bring a little extra joy to your day. ")
            
            NavigationLink {
                ContentView()
            } label: {
                Text("Order more products!")
                    .padding()
                    .foregroundStyle(.white)
                    .background(.pink)
                    .clipShape(Capsule())
            }

        }
        .edgesIgnoringSafeArea(.all)
        .padding()
    }
}

#Preview {
    ThankYou()
}

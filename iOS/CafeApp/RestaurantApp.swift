

import SwiftUI

@main
struct RestaurantApp: App {
    var body: some Scene {
        WindowGroup {
            ContentView()
                .environmentObject(CartManager())
        }
    }
}

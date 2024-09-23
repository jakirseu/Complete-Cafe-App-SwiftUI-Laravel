
import Foundation

struct Product: Identifiable, Codable, Hashable {
    let id: Int
    let title: String
    let price: Double
    let description: String?
    let category: String?
    let image: String?
}


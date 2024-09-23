import Foundation

class DataManager<T: Decodable>: ObservableObject {
    @Published var items: [T] = []
    @Published var isLoading = false
    @Published var errorMessage: String? = nil
    
    private let baseURL: String
    
    init(baseURL: String) {
        self.baseURL = baseURL
    }
    
    // Fetch items from the API
    @MainActor
    func fetchItems() async {
        DispatchQueue.main.async {
            self.isLoading = true
            self.errorMessage = nil
        }
        
        guard let url = URL(string: baseURL) else {
            print(errorMessage ?? "")
            self.errorMessage = "Invalid URL"
            self.isLoading = false
            return
        }
        
        do {
            let (data, response) = try await URLSession.shared.data(from: url)

            guard let httpResponse = response as? HTTPURLResponse, httpResponse.statusCode == 200 else {
                print(errorMessage ?? "")
                self.errorMessage = "Failed to fetch items"
                self.isLoading = false
                return
            }
            
            let decodedItems = try JSONDecoder().decode([T].self, from: data)
            self.items = decodedItems
            self.isLoading = false
            
        } catch {
            print(errorMessage ?? "")
            self.errorMessage = error.localizedDescription
            self.isLoading = false
        }
    }
}

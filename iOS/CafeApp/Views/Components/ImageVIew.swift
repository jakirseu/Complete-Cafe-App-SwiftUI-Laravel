
import SwiftUI

struct ImageVIew: View {
    var imageURL: String?
    var body: some View {
        
        HStack {
            if let imageUrl = imageURL {
                AsyncImage(url: URL(string: imageUrl)) { phase in
                    switch phase {
                    case .empty:
                        ProgressView() // Show loading indicator
                    case .success(let image):
                        image
                            .resizable()
                            .aspectRatio(contentMode: .fill)
                       
                    case .failure:
                        Image( "photo") // Show a placeholder image on failure
                            .resizable()
                            .aspectRatio(contentMode: .fill)
                            .foregroundColor(.gray)
                    @unknown default:
                        EmptyView()
                    }
                }
            } else {
                Image("photo") // Fallback for nil URL
                    .resizable()
                    .aspectRatio(contentMode: .fill)
                    .foregroundColor(.gray)
            }
            
            
        }
    }
}

#Preview {
    ImageVIew()
}

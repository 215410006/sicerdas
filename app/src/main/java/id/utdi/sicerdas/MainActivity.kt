package id.utdi.sicerdas

import android.os.Bundle
import android.widget.Toast
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.foundation.Image
import androidx.compose.foundation.layout.*
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.material3.Button
import androidx.compose.material3.Text
import androidx.compose.runtime.*
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.res.painterResource
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.ui.unit.dp
import androidx.compose.ui.platform.LocalContext

class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
            // Mengganti pesan nama pada row dan column
            MessageCard(Message("215410006", "Ahmad Riky Dzulfikar"))
        }
    }
}

data class Message(val author: String, val body: String)

@Composable
fun MessageCard(msg: Message) {
    val context = LocalContext.current // Mengakses LocalContext

    // Memberikan row pada aplikasi yang dijalankan
    Row(modifier = Modifier.padding(all = 8.dp)) {
        // Mengatur untuk menampilkan image yang dijalankan pada aplikasi
        Image(
            painter = painterResource(R.drawable.profile_p),
            contentDescription = "Contact profile picture",
            modifier = Modifier
                // Mengatur untuk besarnya ukuran image yang ditampilkan
                .size(40.dp)
                // Bentuk image yang ditampilkan
                .clip(CircleShape)
        )

        // Memberikan jarak space pada column
        Spacer(modifier = Modifier.width(8.dp))

        // Memeberikan pengaturan column pada aplikasi yang dibuat
        Column {
            Text(text = msg.author)

            // Menambahkan spasi vertikal antara penulis dan teks pesan
            Spacer(modifier = Modifier.height(4.dp))
            Text(text = msg.body)

            // Tambahkan Button
            Button(
                onClick = {
                    // Kode aksi atau perilaku saat Button diklik
                    Toast.makeText(
                        context,
                        "Tombol di Klik",
                        Toast.LENGTH_SHORT
                    ).show()
                },
                modifier = Modifier
                    .fillMaxWidth()
                    .height(48.dp)
            ) {
                Text(text = "Klik disini")
            }
        }
    }
}

@Preview
@Composable
fun PreviewMessageCard() {
    MessageCard(
        msg = Message("Colleague", "Hey, take a look at Jetpack Compose, it's great!")
    )
}

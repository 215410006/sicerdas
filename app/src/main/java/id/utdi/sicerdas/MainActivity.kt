package id.utdi.sicerdas

import android.os.Bundle
import androidx.activity.ComponentActivity
import androidx.activity.compose.setContent
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.ui.tooling.preview.Preview
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.Image
import androidx.compose.foundation.layout.Row
import androidx.compose.ui.res.painterResource
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.shape.CircleShape
import androidx.compose.ui.Modifier
import androidx.compose.ui.draw.clip
import androidx.compose.ui.unit.dp

class MainActivity : ComponentActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContent {
            //mengganti pesan nama pada row dan coloumn
            MessageCard(Message("215410006", "Ahmad Riky Dzulfikar"))
        }
    }
}

data class Message(val author: String, val body: String)

@Composable
fun MessageCard(msg: Message) {
    // memberikan row pada aplikasi yang dijalankan
    Row(modifier = Modifier.padding(all = 8.dp)) {
        //mengatur untuk menampilkan image yang dijalankan pada aplikasi
        Image(
            painter = painterResource(R.drawable.profile_p),
            contentDescription = "Contact profile picture",
            modifier = Modifier
                // mengatur untuk besarnya ukuran image yang ditampilkan
                .size(40.dp)
                // bentuk image yang ditampilkan
                .clip(CircleShape)
        )

        // memberikan jarak space pada coloumn
        Spacer(modifier = Modifier.width(8.dp))

        //memeberikan penganturan kolom pada aplikasi yang dibuat
        Column {
            Text(text = msg.author)

            // mwnambahkan spasi vertikal antara penulis dan teks pesan
            Spacer(modifier = Modifier.height(4.dp))
            Text(text = msg.body)
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

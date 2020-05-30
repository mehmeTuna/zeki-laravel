import Product from './Views/Product.vue'
import Home from './Views/Home.vue'
import About from './Views/About.vue'
import Contact from './Views/Contact.vue'
import Booking from './Views/Booking.vue'
import Checkout from './Views/Checkout.vue'
import Login from './Views/Login.vue'
import Profile from './Views/Profile.vue'
import Complete from './Views/Complete.vue'
import ÜyeOl from './Views/ÜyeOl.vue'
import Hizmetler from './Views/Hizmetler.vue'
import forgotPassword from '../src/components/forgotPassword.vue'
import cardbasarili from './components/cardBasarili'
import cardbasarisiz from './components/cardBasarisiz'

export const routes =[
    {path:'',
    name:'home',
    component:Home
    },
    {path:'/urunler',
    name:'product',
    component:Product
    },
    {path:'/hizmetler',
    name:'hizmetler',
    component:Hizmetler
    },
    {path:'/hakkımızda',
    name:'about',
    component:About
    
    },
    {path:'/iletisim',
    name:'contact',
    component:Contact
    
    },
    {path:'/rezervasyon',
    name:'booking',
    component:Booking
    
    }, 
    {path:'/alisverisitamamla',
    name:'checkout',
    component:Checkout
    
    },
    {path:'/giris',
    name:'login',
    component:Login
    
    },
    {path:'/profil',
    name:'profile',
    component:Profile
    
    },
    {
      path:'/alisverisbitis',
      name:'complete',
      component:Complete  
    },
    {
      path:'/cardbasarili',
      name:'cardbasarili',
      component:cardbasarili 
    },
    {
      path:'/cardbasarisiz',
      name:'cardbasarisiz',
      component:cardbasarisiz 
    },
    {
      path:'/uyeol',
      name:'uyeol',
      component:ÜyeOl
    },
    {
      path:'/sifreyenile',
      name:'sifreyenile',
      component:forgotPassword
    },
    {
        path:'*',
        component:Home
    }
]


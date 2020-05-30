import Home from "./Views/Home.vue";
import Kurye from "./components/Kurye.vue";
import AddProduct from "./components/ÜrünEkle.vue";
import Rezervasyon from "./components/Rezervasyon.vue";
import Kullanici from "./components/KullanıcıEkle.vue";
import SatisTakip from "./components/SatisTakip.vue";
import KategoriEkle from "./components/KategoriEkle";
import KuryeTakip from "./components/KuryeTakip";
import UyeTakip from "./components/UyeTakip.vue";
export const routes = [
  {
    path: "*",
    component: Home
  },
  {
    path: "/dashboard",
    name: "Home",
    component: Home
  },
  {
    path: "/kurye",
    name: "Kurye",
    component: Kurye
  },
  {
    path: "/addproduct",
    name: "Ürün Ekle",
    component: AddProduct
  },
  {
    path: "/addcategory",
    name: "Kategori Ekle",
    component: KategoriEkle
  },
  {
    path: "/rezervasyon",
    name: "Rezervasyon",
    component: Rezervasyon
  },
  {
    path: "/adduser",
    name: "Kullanici Ekle",
    component: Kullanici
  },
  {
    path: "/satistakip",
    name: "Satis Takip ",
    component: SatisTakip
  },
  {
    path: "/kuryetakip",
    name: "Kurye Takip ",
    component: KuryeTakip
  },
  {
    path: "/uyetakip",
    name: "Uye Takip ",
    component: UyeTakip
  }
];

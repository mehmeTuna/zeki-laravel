<template>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <div>
          <div v-if="errors.length">
            <b>Lütfen hatayı düzeltin:</b>
            <ul>
              <li v-for="error in errors" :key="error.id">{{ error }}</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="validate-form">
          <div class="form-group">
            <i class="ti ti-email text-primary mr-2"></i>
            <label>E-mail</label>
            <input
              v-model="userData.username"
              name="email"
              type="email"
              class="form-control"
              id="email"
            />
          </div>
          <div class="form-group">
            <i class="ti ti-key text-primary mr-2"></i>

            <label>Şifre</label>
            <input
              v-model="userData.password"
              name="Şifre"
              type="password"
              id="password"
              class="form-control"
            />
            <i class="ti ti-key text-primary mr-2"></i>

            <label>Şifre Tekrar</label>

            <input v-model="userData.rePassword" name="Şifre" type="password" class="form-control" />
            <i class="ti ti-user text-primary mr-2"></i>

            <label>Ad</label>
            <input v-model="userData.name" name="name" type="text" class="form-control" id="name" />
            <i class="ti ti-user text-primary mr-2"></i>

            <label>Soyad</label>

            <input
              v-model="userData.surname"
              name="surname"
              type="text"
              class="form-control"
              id="surname"
            />
            <i class="ti ti-mobile text-primary mr-2"></i>

            <label>Telefon</label>
            <input
              v-model="userData.phone"
              name="phone"
              type="number"
              class="form-control"
              id="phone"
            />
            <i class="ti ti-location-pin text-primary mr-2"></i>
            <label>Şehir</label>

            <div class="select-container">
              <select disabled class="form-control">
                <option selected value>Adana</option>
              </select>
            </div>
            <i class="ti ti-location-pin text-primary mr-2"></i>
            <label>Mahalle</label>

            <div class="select-container">
              <select class="form-control" v-model="userData.selectedAddress">
                <option
                  v-for="street in streets "
                  :key="street.id"
                  :value="street.id"
                >{{street.name}}</option>
              </select>
            </div>

            <i class="ti ti-location-pin text-primary mr-2"></i>

            <label>Adres</label>
            <textarea
              v-model="userData.adress"
              name="message"
              id="message"
              cols="20"
              rows="2"
              class="form-control"
              required
            ></textarea>

            <div class="form-group" style="margin-top:5px">
              <label class="custom-control custom-radio">
                <input
                  type="checkbox"
                  id="one"
                  v-model="userData.politics"
                  name="payment_type"
                  class="custom-control-input"
                />

                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">
                  <p class="lead" data-toggle="modal" data-target="#exampleModalCenter">
                    <span style="color:blue">Kullanıcı Sözleşmesini</span>
                    <span class="lead">ve Kişisel Verilerin Korunması Politikasını kabul ediyorum</span>
                  </p>
                </span>
              </label>
            </div>
          </div>

          <!-- Modal -->
          <div
            class="modal fade"
            id="exampleModalCenter"
            tabindex="-1"
            role="dialog"
            aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true"
          >
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Zeki Usta Kullanıcı Sözleşmesi</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  1. Sözleşmenin Onaylanması
                  Kullanıcı kayıt formu doldurularak veya sosyal medya ağları üyeliği (Facebook, Twitter, Instagram, Pinterest ve benzerleri) aracılığıyla www.zekiustakebap.com adresinden veya bu adres üzerinden erişilebilen web-sitelerini kapsayan siteler üzerinden zekiustakebap.com sistemine üye olunabilir. Her zekiustakebap.com kullanıcısı, Zeki Usta Yemek Gıda Ziraat İnşaat Otomotiv Üretim Ticaret Pazarlama Ltd. Şti. (“zekiustakebap.com”) ile akdetmiş olduğu işbu Kullanıcı Sözleşmesi (“Sözleşme”) hükümlerine uyacağını kabul ve taahhüt eder.
                  2. Hizmetler
                  zekiustakebap.com kullanıcılarına internet ortamında, mobil telefonlarda, akıllı TV sistemlerinde veya benzer platformlarda geliştirilebilen uygulamalardan yemek siparişi verme imkanı ve buna ilişkin sair hizmetler sunar.
                  3. zekiustakebap.com Kullanıcı Sistemi
                  Her zekiustakebap.com kullanıcısı, kendisinin belirleyeceği bir “kullanıcı adı” veya e-posta adresi ile “şifre”ye sahip olur.
                  “Kullanıcı adı” e-posta adreslerinde olduğu gibi her üyeye özeldir ve aynı kullanıcı adı farklı üyelere verilmez.
                  Her kullanıcının zekiustakebap.com üyeliği gerektiren sistemlere bağlanabilmesi için kullanıcı adını veya kayıtlı e-posta adresi ile şifresini girmesi gereklidir. Bu işlem zekiustakebap.com sistemine giriş yapmak şeklinde tanımlanmıştır. Kullanıcılar, diledikleri takdirde ilgili kullanıcı sözleşmelerini onaylamak kaydıyla zekiustakebap.com sistemine giriş yaptıkları kullanıcı adı veya e-posta adresi ve şifre ile zekiustakebap.com sistemine dahil diğer sitelere de giriş yapabilirler.
                  “Şifre” sadece ilgili kullanıcının bilgisi dâhilindedir. Kullanıcı şifresi unutulduğu takdirde zekiustakebap.com, talep üzerine kullanıcının zekiustakebap.com sisteminde kayıtlı e-posta adresine yeni şifre oluşturabilmek için bir bağlantı gönderecektir. Şifre'nin belirlenmesi ve korunması tamamıyla kullanıcının kendi sorumluluğundadır ve zekiustakebap.com şifre kullanımından doğacak problemlerden veya oluşabilecek zararlardan kesinlikle sorumlu değildir.
                  zekiustakebap.com kullanıcılarını zekiustakebap.com’da kayıtlı adreslerinin bulunduğu bölgelerdeki ve sair şekilde yararlanabilecekleri promosyonlar ile zekiustakebap.com sistemi dahilindeki yeni hizmet veya projelerden e-posta yolu ile haberdar edebilecektir. Ayrıca zekiustakebap.com kullanıcılarına sosyal medya kanalları dahil olmak üzere kullanıcıların zekiustakebap.com com sistemi ile paylaştıkları her türlü iletişim kanalı üzerinden ulaşabilir ve çeşitli promosyon, kampanya ve benzer bilgileri paylaşabilecektir.
                  Kullanıcıların belirlemiş oldukları zekiustakebap.com sisteminde kayıtlı isim, adres ve telefon numarası, siparişin daha çabuk ve doğru teslimi amacıyla siparişi teslim eden motorlu ekip ile paylaşılacaktır.
                  zekiustakebap.com, sisteminde kayıtlı isim, adres ve telefon numarasının siparişi teslim eden motorlu ekip ile paylaşılmasından dolayı kullanıcı ve üye işyeri arasında ortaya çıkabilecek her türlü problemden veya oluşabilecek zarardan kesinlikle sorumlu değildir.
                  zekiustakebap.com sisteminin kullanılması ile oluşacak data ve verilerin tüm fikri haklarına sahiptir. zekiustakebap.com, söz konusu bilgilerle kullanıcı üyelik bilgilerini açıklamadan demografik bilgiler içeren raporlar düzenleyebilir veya bu tarz bilgileri veya raporları kendisi kullanabilir ve bu rapor ve/veya istatistikleri iş ortakları ile üçüncü kişilerle bedelli veya bedelsiz paylaşabilir. Bu işlemler zekiustakebap.com Gizlilik Politikası hükümlerine aykırılık teşkil etmez.
                  4. Kullanıcının Yükümlülükleri
                  Kullanıcı, zekiustakebap.com hizmetlerinden yararlandığı sırada,
                  Kullanıcı kayıt formunda yer alan bilgilerin doğru olduğunu ve ve zekiustakebap.com da oluşturulmuş her bir Kullanıcı adı için yalnızca bir adet e-posta tanımlanabileceğini, tanımlanan e-posta adresinin değiştirilemeyeceğini , yeni bir e-posta adresinin ancak zekiustakebap.com üzerinde yeni bir kullanıcı oluşturulması halinde tanımlanılabileceğini; bu bilgilerin gerekli olduğu durumlarda bilginin hatalı veya noksan olmasından (şifre unutma gibi) doğacak kendisinin ya da üçüncü kişilerin zararlarından dolayı sorumluluğun kendisine ait olduğunu, bu hallerde zekiustakebap.com üyeliğinin sona erebileceğini;
                  “Kullanıcı adı” veya kayıtlı e-posta adresiyle yapacağı her türlü işlemden bizzat kendisinin sorumlu olduğunu;
                  zekiustakebap.com tarafından verilen hizmetlerin ve yazılımların telif hakkının zekiustakebap.com'a ait olduğunu, bu yazılımları hiçbir şekilde çoğaltıp, dağıtmayacağını;
                  zekiustakebap.com hizmetlerini kullandığında ileri sürdüğü şahsi fikir, düşünce, ifade, zekiustakebap.com ortamına eklediği dosyaların, gönderdiği kişisel bilgilerinin sorumluluğunun kendisine ait olduğunu ve üye işyeri ile kullanıcı arasında oluşabilecek ihtilaflar dahil ancak bunlarla sınırlı olmamak üzere zekiustakebap.com'un bu dosyalardan dolayı hiçbir şekilde sorumlu tutulamayacağını, zekiustakebap.com’un bu görüş ve düşünceleri yayımlayıp, yayımlamamakta serbest olduğunu ayrıca bu görüş ve yorumları moderatörler aracılığıyla düzenleyip, imla hatalarını düzeltme hakkı bulunduğunu;
                  zekiustakebap.com servislerinin kullanımı sırasında kaybolacak ve/veya eksik alınacak, yanlış adrese iletilecek bilgi mesaj ve dosyalardan zekiustakebap.com'un sorumlu olmayacağını;
                  Kullanıcı verilerinin yetkisiz kişilerce okunmasından veya kullanılmasından dolayı gelebilecek zararlardan ötürü zekiustakebap.com'un sorumlu tututalamayacağını;
                  Kullanıcı paylaşımlarının üçüncü kişiler tarafından izinsiz şekilde kullanılmasından, paylaşılmasından veya yayınlanmasından dolayı gelebilecek zararlardan zekiustakebap.com’un sorumlu olmayacağını;
                  Tehdit edici, ahlak dışı, ırkçı, Türkiye Cumhuriyeti kanunlarına, uluslararası anlaşmalara aykırı, politik mesajlar içeren, 3. kişilerin fikri veya sınai mülkiyet haklarını ihlal eder nitelikte kullanıcı adı, fotoğraf ve rumuz kullanmamayı; mesaj veya yorum göndermemeyi;
                  Ortama eklenecek kullanıcı adları, fotoğraflar, yazışmalar, konu başlıkları ve rumuzların genel ahlak, görgü ve hukuk kurallarına uygun olmasını; politik mesajlar içermemesini; ve söz konusu ibareler, yazışmalar ve fotoğraflar ile ilgili tüm yayımlama, işleme ve çoğaltma, yayma, temsil, işaret, ses ve/veya görüntü nakline yarayan araçlarla umuma iletim, üçüncü kişilere devir ve temlik hakları dâhil olmak üzere 5846 sayılı ve 5.12.1951 tarihli Fikir ve Sanat Eserleri Kanunu’nda sayılan tüm mali hakların zekiustakebap.com’a devredildiğini;
                  Diğer kullanıcıları taciz ve tehdit etmemeyi;
                  Diğer kullanıcıların zekiustakebap.com sistemini kullanmasını olumsuz etkileyecek şekilde davranmamayı;
                  zekiustakebap.com sistemi veya ona bağlı olarak geliştirilen sistem ve uygulamalarda yer alan hizmetleri kötüye kullanmayacağını ve bu sistemi kullanan diğer kullanıcıların haklarını ihlal eden nitelikte veya zarar veren hiçbir davranışta bulunmayacağını ve söz konusu kötüye kullanım neticesinde zekiustakebap’ın veya ilgili kullanıcının uğrayacağı tüm zararlardan sorumluluğun tamamen kendisine ait olduğunu ve böyle bir kullanımın tespit edilmesi halinde zekiustakebap’ın bu kullanıcının ilgili hizmetteki hesabını ya da hesabının kullanıcı adı, profil fotoğrafı ve benzeri kısımlarını kapatma veya limitleme veya zekiustakebap üyeliğini sona erdirme hakkının bulunduğunu;
                  zekiustakebap.com hizmetleri kullanarak elde edilen herhangi bir kayıt veya elde edilmiş malzemelerin tamamen kullanıcının rızası dâhilinde olduğunu, kendi bilgisayarında yaratacağı arızalar, bilgi kaybı ve diğer kayıpların sorumluluğunun tamamen kendisine ait olduğunu, zekiustakebap.com sisteminin kullanımından dolayı uğrayabileceği zararlardan dolayı zekiustakebap.com'dan tazminat talep etmemeyi;
                  zekiustakebap.com'un, dilediği zaman veya sürekli olarak tüm sistemi izleyebileceğini;
                  Kurallara aykırı davrandığı takdirde zekiustakebap.com'un gerekli müdahalelerde bulunma ve kullanıcıyı hizmet dışına çıkarma ve üyeliğine son verme hakkına sahip olduğunu,
                  zekiustakebap.com'un, kendi sistemini ticari amaçla kullanabileceğini;
                  Kanunlara göre iletilmesi yasak olan bilgileri iletmemeyi ve zincir posta (chain mail), yazılım virüsü (vb.) gibi gönderilme yetkisi olmayan verileri paylaşmamayı;
                  Başkalarına ait kişisel bilgileri kayıt etmemeyi, yaymamayı, kötüye kullanmamayı;
                  Online Ödeme Yöntemi ile ödeme yapılmadığı durumda sipariş teslimi sırasında hizmetin daha önceden kendilerine bildirilmiş olan ücretini seçilen ödeme aracıyla ödemek durumunda olduğunu aksi takdirde ürünün kendilerine teslim edilmeyebileceğini;
                  zekiustakebap.com sisteminde çerez (cookie/tanımlama bilgileri) kullanıldığını, çerezlerin bir internet sitesinin kullanıcının bilgisayarındaki sabit diskte çerez dosyasına aktardığı bilgi parçaları olduğunu, bunların kullanıcıların zekiustakebap.com’da gezinmesine olanak sağladığını ve gerektiğinde siteye erişen kullanıcıların ihtiyaçlarına uygun içeriklerin hazırlanmasına yardımcı olduğunu beyan, taahhüt ve kabul eder.
                  5. zekiustakebap.com'a Tanınan Yetkiler
                  zekiustakebap.com herhangi bir zamanda sistemin çalışmasını geçici bir süre askıya alabilir veya tamamen durdurabilir. zekiustakebap.com güvenliği şüphesi doğuran kullanıcı işlemlerinden dolayı ilgili kullanıcıların Online Ödeme Yöntemi aracılığı ile ödeme yapma imkânını geçici bir süre askıya alabilir veya tamamen durdurabilir. Sistemin veya Online Ödeme Yöntemi kullanımının geçici bir süre askıya alınması veya tamamen durdurulmasından dolayı zekiustakebap.com’un kullanıcılarına veya üçüncü kişilere karşı hiçbir sorumluluğu olmayacaktır. Kullanıcı adı veya e-posta ile şifre zekiustakebap.com tarafından sunulan başvuru alanlarının doldurulmasından sonra görüntülenecek ve onaylanacaktır. zekiustakebap.com kullanıcı kayıt formunu eksiksiz doldurmuş üyelerin veya zekiustakebap.com sistemine giriş yapan kullanıcıların yeni bir şifreye sahip olmalarını veya şifrelerini kullanmalarını münhasıran süresiz olarak engelleyebilecektir. zekiustakebap.com, hizmetlerinin zamanında, güvenli ve hatasız olarak sunulması, hizmet kullanımından elde edilen sonuçların doğru ve güvenilir olması, hizmet kalitesinin beklentilere cevap vermesi için gerekli özeni gösterecektir ancak bunları taahhüt etmemektedir. zekiustakebap.com kullanıcıların sistemden yararlanmaları sırasında ortamda bulunduracakları dosyaların, mesajların bazılarını veya tamamını uygun göreceği periyotlarla yedekleme ve silme yetkisine sahiptir. Yedekleme ve silme işlemlerinden dolayı zekiustakebap.com sorumlu tutulmayacaktır. zekiustakebap.com kendi ürettiği ve/veya dışardan satın aldığı bilgi, belge, yazılım, tasarım, grafik vb. eserlerin mülkiyet ve mülkiyetten doğan telif haklarına sahiptir. zekiustakebap.com kullanıcılarının ürettiği ve yayınlanmak üzere kendi iradesiyle sisteme yüklediği (örneğin kullanıcı resimleri, panoya eklediği mesaj, şiir, haber, dosya gibi) bilgi, belge, yazılım, tasarım, grafik vb. eserlerin her türlü yazılı ve görsel mecrada yayınlanma, işleme, sosyal medya ağlarında paylaşma ve/veya zekiustakebap.com sistemi içinde zekiustakebap.com tarafından uygun görülecek başka bir adrese taşıma veya kendi takdirinde olmak üzere internet sitesinden kaldırma haklarına sahiptir. Yayınlanan bu bilgilerin başka kullanıcılar tarafından kopyalanması, işlenmesi ve/veya yayınlanması ihtimal dâhilindedir. Bu hallerde kullanıcı, zekiustakebap.com'dan hiçbir telif ücreti talep etmeyecektir. Fiyat ve ürün özellik bilgilerinde hata oluştuğu takdirde zekiustakebap.com kullanıcıları bilgilendirerek, bu hatayı düzeltecek şekilde ürün teslimatı yapabilir veya siparişi iptal edebilir. zekiustakebap.com sisteminde satışa sunulan ürünlerin içeriğine dair doğru ve dürüst açıklama yapılmasına dair zekiustakebap.com gerekli özeni gösterecektir ancak üye işyerlerinin sipariş içeriklerine dair yaptıkları eksik ve/veya hatalı açıklamalardan dolayı oluşacak problemlerden veya zararlardan zekiustakebap.com sorumlu değildir. zekiustakebap.com, kullanıcının zekiustakebap.com com sistemi dışındaki web-sitelerine geçişini sağlayabilir. Bu takdirde kullanıcı geçiş yapacağı sitelerin içeriğinden zekiustakebap.com'un sorumlu olmadığını peşinen kabul eder. zekiustakebap.com kullanıcı üyeliği gerektirmeyen hizmetleri zaman içinde üyelik gerektiren bir hale dönüştürülebilir, ilave hizmetler açabilir, bazı hizmetlerini kısmen veya tamamen değiştirebilir veya ücretli hale dönüştürebilir. Bu durumda kullanıcının Sözleşme’yi feshederek, üyelikten ayrılma hakkı saklıdır. zekiustakebap.com, ileride doğacak teknik zaruretler ve mevzuata uyum amacıyla kullanıcıların aleyhine olmamak kaydıyla işbu Sözleşme’nin uygulamasında değişiklikler yapabilir, mevcut maddelerini değiştirebilir veya yeni maddeler ilave edebilir.
                  6. Kullanım Amacı
                  Kullanıcılar, zekiustakebap.com sistemi üzerinde verilen tüm siparişlerin, yapılan tüm alışverişlerin kişisel kullanım amaçlı olduğunu, bunların tekrar satış amaçlı olmadığını kabul ederler.
                  7. Ödeme
                  zekiustakebap.com kullanıcıları zekiustakebap.com sisteminden verdikleri siparişin ücretini, sipariş verirken seçtikleri şekilde teslim esnasında ödeyebilir. Kullanıcılar ayrıca Online Ödeme Yöntemi kullanarak banka kartı, kredi kartı veya benzer bir ödeme aracı ile diğer ödeme sistemleri (örneğin PayPal) vasıtasıyla anında online ödeme de yapabileceklerdir. Online Ödeme Yöntemi seçeneği kullanılarak yapılan ödemelerde, kartın hamili haricinde bir başkası tarafından hukuka aykırı şekilde kullanılması halinde 23.02.2006 tarihli 5464 sayılı Banka Kartları ve Kredi Kartları Kanunu ve 10.03.2007 tarihli ve 26458 sayılı Resmi Gazete’de yayımlanan Banka Kartları ve Kredi Kartları Hakkında Yönetmelik hükümlerine göre işlem yapılır. Kullanıcılar, Online Ödeme Yöntemi kullanılarak verilen siparişlerde ödemeyi zekiustakebap.com ‘a yapmakla ödeme yükümlülüklerini ifa etmiş olmaktadır. Vale Hizmeti kullanılarak online ödeme yöntemi, kapıda kredi kartı/banka kartıyla ödeme yöntemi, kapıda nakit ödeme yöntemi dahil fakat bunlarla sınırlı olmamak üzere her türlü ödeme yöntemiyle gerçekleşen siparişlerde, zekiustakebap.com, sipariş edilen ürünlere ilişkin bedelleri motorlu kuryelerine tahsil etmek için münhasır olarak yetkilendirilmiştir. Kullanıcılar, vale hizmeti kullanılarak verilen siparişlerde ödemeyi online ödeme yöntemi, kapıda kredi kartı/banka kartıyla ödeme yöntemi, kapıda nakit ödeme yöntemi dahil fakat bunlarla sınırlı olmamak üzere her türlü ödeme yöntemiyle yapmakla, restorana ve zekiustakebap.com'a karşı ödeme yükümlülüklerini ifa etmiş olmaktadırlar.
                  8. Kişisel Veri
                  Kullanıcı zekiustakebap.com’a üye olurken Kullanıcı Sözleşmesini onaylamak ve üyelik sonrası Web Sitesi içerisindeki hareketleri esnasında, veri sorumlusu zekiustakebap.com ile paylaştıkları ad, soyad, elektronik posta adresi, sipariş adres/adresleri, telefon numarası gibi kişisel verilerinin (“Kişisel Veri/ler”) Kişisel Verilerin Korunması Hakkındaki Kanun’da belirlenmiş olan esaslar çerçevesinde işlenmesini kabul ve beyan eder. Kişisel Veriler zekiustakebap.com ve zekiustakebap.com iştirakleri tarafından işbu sözleşmesel ilişki kapsamında ve zekiustakebap.com ve iştiraklerinin sözleşmesel ilişkisi bulunan iş ortakları tarafından pazarlama, analiz, istatistik gibi amaçlarla işlenebilir. Ek olarak Kullanıcılar Kişisel Verileri dışındaki sipariş bilgileri (sipariş verdikleri restoranlar, sipariş verilen ürün tipi, sipariş adedi, sipariş saati, sipariş verilen bölge gibi Web Sitesi (veya kullanılan benzeri mobil veya elektronik mecra) üzerindeki tüm davranışları, sipariş detayları gibi) ve benzeri verilerinin (“Veri/er”) zekiustakebap.com, zekiustakebap.com iştirakleri ve iş ortakları tarafından kaydedilmesi, işlenmesi ve listelenmesinde ve/veya anonimleştirilerek analizlerde 3. kişilerle hizmetin daha iyi sağlanması veya çeşitli uygulamaların veya programların zekiustakebap.com üzerinde çalıştırılabilmesi için anonim şekilde kullanılmasına açık rızalarının olduğunu kabul ve beyan ederler.
                  10. Ürün Teslimatı
                  zekiustakebap.com sisteminde seçtiği adreste bulunamaz ise siparişi kesinlikle başka bir adrese bırakılmayacaktır. Bu durum çerçevesinde kullanıcı kendisinin bulunmadığı bir adrese sipariş vermiş olduğu için doğacak kanuni yükümlülükleri kabul etmek durumundadır.
                  11. Ücret İadesi
                  Online Ödeme Yöntemi ile ödemesi yapılmış siparişlerle sınırlı olmak üzere kullanıcıya ücret iadesi ancak
                  kullanıcı adresinin sipariş verilen restoranın gönderim alanı dışında olması nedeniyle siparişin zorunlu iptali;
                  siparişin bir kısmının veya tamamının restoranda mevcut olmaması nedeniyle siparişin kısmen veya tamamen zorunlu iptali;
                  Sipariş edilen üründen memnun kalınmaması nedeniyle zekiustakebap.com onayının alınmasının akabinde yapılan sipariş iptali; ve
                  Sipariş edilen ürünün teslimatının gecikmesi durumunda iptal yapılacaktır. İptale konu siparişe ilişkin zekiustakebap.com bir fiş veya fatura düzenlemiş ve bu kullanıcıya teslim edilmiş ise ilgili restoran görevlisine iadesi gerekmektedir.
                  zekiustakebap.com, yalnızca kullanıcıdan kaynaklanan sebeplerden dolayı (örneğin kullanıcının evde olmaması, yanlış adres bilgisi vermesi, siparişi teslim almaması gibi) ücret iadesi yapmama hakkını saklı tutar.
                  Online Ödeme Yöntemi dışındaki ödeme vasıtaları ile ödemesi yapılmış siparişlerde ücret iadesi, zekiustakebap.com tarafından doğrudan yapılmaktadır.
                  12. Bilgilerin Saklanması ve İspat Yükümlülüğü:
                  zekiustakebap.com sisteminde kayıtlı kullanıcı bilgileri, siparişleri, yorum/değerlendirmeleri vb. zekiustakebap.com Gizlilik Politikası’na tabi olacak şekilde en az üç (3) yıl boyunca saklanır. İşbu Sözleşme’nin ifasından doğacak her türlü uyuşmazlıkta zekiustakebap.com sisteminde saklanan veriler ile kullanıcı kayıtları bağlayıcı ve kesin delil teşkil eder. İşbu Sözleşme Türkiye Cumhuriyeti kanunlarına tabidir. Sözleşme’nin ifasından doğabilecek her türlü uyuşmazlığın çözümünde Adana Merkez Mahkeme ve İcra Müdürlükleri yetkilidir.
                  14. Yürürlük
                  İşbu Sözleşme taraflar arasında kullanıcının, kullanıcı kayıt formunu doldurmasından itibaren süresiz olarak yürürlüğe girer.
                  15. Fesih
                  Taraflar işbu Sözleşme’yi diledikleri zaman sona erdirebileceklerdir. Sözleşme’nin feshi anında tarafların birbirlerinden olan alacak hakları etkilenmez.
                </div>
              </div>
            </div>
          </div>

          <div>
            <button @click="checkForm" class="btn btn-success btn-block">
              <span>Üye Ol!</span>
            </button>
          </div>
        </div>
      </div>
      <div class="col-md-3"></div>

      <div class="col-md-3"></div>

      <div class="col-md-9">
        <h4>
          Zaten üyeliğiniz var mı?
          <router-link tag="a" to="/giris">
            <span class="lead" style="color:blue">Giriş Yap!</span>
          </router-link>
        </h4>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import swal from "sweetalert";

export default {
  data() {
    return {
      errors: [],
      userData: {
        username: "",
        password: "",
        rePassword: null,
        adress: "",
        name: "",
        surname: "",
        date: 0,
        politics: null,
        phone: "",
        selectedAddress: ""
      },
      streets: []
    };
  },
  methods: {
    checkForm: function(e) {
      this.errors = [];
      if (!this.userData.password) this.errors.push("Şifre giriniz.");
      if (!this.userData.username) {
        this.errors.push("Email giriniz.");
      }
      if (!this.validEmail(this.userData.username)) {
        this.errors.push("Yanlış email girdiniz.");
      }
      if (!this.userData.name) {
        this.errors.push("Ad giriniz");
      }
      if (!this.userData.adress) {
        this.errors.push("Adress giriniz");
      }
      if (!this.userData.surname) {
        this.errors.push("Soyad giriniz");
      }
      if (!this.userData.politics) {
        this.errors.push("Sözleşmeyi Kabul Ediniz");
      }
      if (this.validEmail(this.userData.username)) {
        const url = "user/register";

        axios
          .post(url, this.userData)
          .then(response => {
            console.log(response);
            if (response.data.status == "registered") {
              //this.$router.go(this.$router.currentRoute)
              swal({
                title: "Kayıt Olundu!",
                text: "Ana sayfaya yönlendiriliyorsunuz!",
                icon: "success",
                timer: 1500
              }).then(() => {
                window.location.href = "anasayfa";
              });
            } else if (response.data.status == "emailfailed") {
              //this.$router.go(this.$router.currentRoute)
              swal({
                title: "E-posta Zaten Kayıtlı!",
                text: "Farklı E-posta Deneyiniz!",
                icon: "warning",
                timer: 1500
              });
            } else if (response.data.status == "erroneousData") {
              //this.$router.go(this.$router.currentRoute)
              swal({
                title: "Hatalı Veri!",
                text: "Bilgileri Kontrol Ediniz!",
                icon: "warning",
                timer: 1500
              });
            } else {
              swal({
                title: "Lütfen bilgileri kontrol ediniz !",

                icon: "warning",
                timer: 1500
              });
            }
          })
          .catch(e => console.log(e));
      }

      if (!this.errors.length) return true;
      e.preventDefault();
    },

    validEmail: function(email) {
      var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    },
    adressInfo() {
      const url = "addressList";
      axios.get(url).then(res => {
        this.streets = res.data;
      });
    }
  },
  created() {
    this.adressInfo();
  }
};
</script>

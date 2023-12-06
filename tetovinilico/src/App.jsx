import Formulario from './components/Formulario'
import Header from './components/Header'
import SlideTeto from './components/SlideTeto'
import FajaServicios from './components/FajaServicios'
import Lineas from './components/Lineas'
import FeaturedProducts from './components/FeaturedProducts'
import Ventajas from './components/Ventajas'
import Encastres from './components/Encastres'
import Galery from './components/Galery'
import ShowRoom from './components/ShowRoom'
import LastCta from './components/LastCta'
import Footer from './components/Footer'
import Whatsapp from './components/Whatsapp'

function App() {
  return (
    <main>
      <Whatsapp />
      <Header />
      <SlideTeto />
      <Formulario />
      <FajaServicios />
      <Lineas />
      <FeaturedProducts />
      <Ventajas />
      <Encastres />
      <Galery />
      <ShowRoom />
      <LastCta />
      <Footer />
    </main>
  )
}

export default App

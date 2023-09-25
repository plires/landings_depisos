import Formulario from './components/Formulario'
import Header from './components/Header'
import SlideGriferia from './components/SlideGriferia'
import FajaServicios from './components/FajaServicios'
import Lineas from './components/Lineas'
import FeaturedProducts from './components/FeaturedProducts'
import Aplications from './components/Aplications'
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
      <SlideGriferia />
      <Formulario />
      <FajaServicios />
      <Lineas />
      <FeaturedProducts />
      <Aplications />
      <Galery />
      <ShowRoom />
      <LastCta />
      <Footer />
    </main>
  )
}

export default App

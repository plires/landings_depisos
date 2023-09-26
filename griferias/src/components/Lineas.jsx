import LineaProducto from './LineaProducto'
import LineaDescription from './LineaDescription'

import './lineas.css'

const Lineas = () => {
  const mozart = {
    logo_img_src: './img/logo-griferia-mozart.png',
    logo_img_alt: 'logo de griferias mozart',
    product_img_src: './img/linea-griferia-mozart.jpg',
    product_img_alt: 'linea de griferias mozart',
    description:
      'Soluciones modernas de alta calidad y estilo, diseño e innovación accesibles para el hogar.',
  }

  const hidromet = {
    logo_img_src: './img/logo-griferia-hidromet.png',
    logo_img_alt: 'logo de griferias hidromet',
    product_img_src: './img/linea-griferia-hidromet.jpg',
    product_img_alt: 'linea de griferias hidromet',
    description:
      'Fabricadas con materiales duraderos y tecnología de vanguardia, lo que garantiza un rendimiento confiable y una larga vida útil.',
  }

  return (
    <section className='container-fluid lineas'>
      <div className='container'>
        <div className='row'>
          <div className='col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2'>
            <div className='row'>
              <div className='col-12'>
                <h2>Nuestras líneas</h2>
              </div>
            </div>
            <div className='row'>
              <div className='col-sm-6'>
                <LineaProducto marca={mozart} />
              </div>
              <div className='col-sm-6 content_data'>
                <LineaDescription description={mozart.description} />
              </div>
            </div>
            <div className='row'>
              <div className='col-sm-6 content_data'>
                <LineaDescription description={hidromet.description} />
              </div>
              <div className='col-sm-6'>
                <LineaProducto marca={hidromet} />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
export default Lineas

import LineaProducto from './LineaProducto'
import LineaDescription from './LineaDescription'

import './lineas.css'

const Lineas = () => {
  const line1 = {
    logo_img_src: './img/tetovinilico/logo-teto-lineas.png',
    logo_img_alt: 'logo de tetovinilico 1',
    product_img_src: './img/tetovinilico/linea-teto-a.jpg',
    product_img_alt: 'linea origens',
    description:
      'La línea Origens nos lleva a las raices, recrea toda la esencia de la madera: noble y serena para darte un ambiente acogedor.',
  }

  const line2 = {
    logo_img_src: './img/tetovinilico/logo-teto-lineas.png',
    logo_img_alt: 'logo de tetovinilico 2',
    product_img_src: './img/tetovinilico/linea-teto-b.jpg',
    product_img_alt: 'linea plus agar',
    description:
      'Plus-Agar, nuestra selección más intrépida de la madera. Expresa la naturalidad de forma lúdica, lo que posibilita ambientes llenos de personalidad.',
  }

  return (
    <section className='container-fluid lineas'>
      <div className='container'>
        <div className='row'>
          <div className='col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2'>
            <div className='row'>
              <div className='col-12'>
                <h2>Línea Origens</h2>
              </div>
            </div>
            <div className='row'>
              <div className='col-sm-6'>
                <LineaProducto marca={line1} />
              </div>
              <div className='col-sm-6 content_data'>
                <LineaDescription description={line1.description} />
              </div>
            </div>
            <div className='row'>
              <div className='col-12'>
                <h2>Línea Plus - Agar</h2>
              </div>
            </div>
            <div className='row'>
              <div className='col-sm-6 content_data'>
                <LineaDescription description={line2.description} />
              </div>
              <div className='col-sm-6'>
                <LineaProducto marca={line2} />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}
export default Lineas

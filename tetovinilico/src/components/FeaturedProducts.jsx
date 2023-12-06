import { useContext } from 'react'
import { StoreContext } from '../context/store'
import { getFeaturedProducts, getCurrentMonth } from './../utils/dataUtils'
import Product from './Product'
import './../../node_modules/slick-carousel/slick/slick.css'
import './../../node_modules/slick-carousel/slick/slick-theme.css'
import './featured-products.css'

const FeaturedProducts = () => {
  const featuredProducts = getFeaturedProducts('featuredProducts')
  const { isPromo } = useContext(StoreContext)

  return (
    <section className='featured_products container-fluid'>
      <div data-aos='fade-up' className='row'>
        <div className='col-sm-12'>
          <h2>Revestimientos para techos premium</h2>
          {isPromo && (
            <p className='promo title_promo'>
              MODELOS EN PROMOCIÓN <br />
              ¡SÓLO POR {getCurrentMonth()}!
            </p>
          )}
        </div>
      </div>

      <div className='container'>
        <div data-aos='fade-up' className='row'>
          {featuredProducts.map(product => (
            <div key={product.id} className='col-sm-6 col-md-3'>
              <Product product={product} />
            </div>
          ))}
        </div>
      </div>
    </section>
  )
}

export default FeaturedProducts

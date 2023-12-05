import { useContext } from 'react'
import { StoreContext } from '../context/store'
import { getFeaturedProducts, getCurrentMonth } from './../utils/dataUtils'
import Slider from 'react-slick'
import './../../node_modules/slick-carousel/slick/slick.css'
import './../../node_modules/slick-carousel/slick/slick-theme.css'
import './featured-products.css'

const settings = {
  dots: false,
  arrows: false,
  infinite: true,
  autoplay: true,
  speed: 500,
  slidesToShow: 6,
  slidesToScroll: 1,
  initialSlide: 0,
  pauseOnHover: true,
  responsive: [
    {
      breakpoint: 1600,
      settings: {
        slidesToShow: 5,
        arrows: false,
      },
    },
    {
      breakpoint: 1300,
      settings: {
        slidesToShow: 4,
        arrows: false,
      },
    },
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        arrows: false,
      },
    },
    {
      breakpoint: 768,
      settings: {
        arrows: false,
        slidesToShow: 2,
      },
    },
    {
      breakpoint: 500,
      settings: {
        arrows: false,
        slidesToShow: 1,
      },
    },
  ],
}

const FeaturedProducts = () => {
  const featuredProducts = getFeaturedProducts('featuredProducts')
  const { setMessage, isPromo } = useContext(StoreContext)

  const scrollToTop = (product, code) => {
    const msg = isPromo
      ? `Quiero consultar por el producto código: ${code}, ${product}, que se encuentra en promoción...`
      : `Necesito hacer una consulta por el producto código: ${code}, ${product}`

    window.scroll({
      top: 350,
      left: 0,
      behavior: 'smooth',
    })
    setMessage(msg)
  }

  return (
    <section data-aos='fade-up' className='featured_products'>
      <h2>Nuestras griferías</h2>
      {isPromo && (
        <p className='promo title_promo'>
          MODELOS EN PROMOCIÓN <br />
          ¡SÓLO POR {getCurrentMonth()}!
        </p>
      )}
      <Slider {...settings}>
        {featuredProducts.map(product => (
          <div key={product.id} className='container_product'>
            <div className='content_product'>
              <div className='superior'>
                <p className='code'>{product.code}</p>
                {isPromo && (
                  <img
                    className='img-fluid img_logo_promo'
                    src={product.promo_img_src}
                    alt={product.promo_img_alt + ' ' + product.img_alt}
                  />
                )}
              </div>
              <img
                className='img-fluid img_thumbnail'
                src={product.img_src}
                alt={product.img_alt}
              />
              <div className='inferior'>
                <p>{product.name}</p>
                <p>{product.brand}</p>
                <button
                  className='btn'
                  onClick={() => scrollToTop(product.name, product.code)}
                >
                  Consultar
                </button>
              </div>
            </div>
          </div>
        ))}
      </Slider>
    </section>
  )
}

export default FeaturedProducts

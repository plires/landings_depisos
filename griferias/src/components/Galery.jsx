import Slider from 'react-slick'
import './../../node_modules/slick-carousel/slick/slick.css'
import './../../node_modules/slick-carousel/slick/slick-theme.css'
import { getGalery } from './../utils/dataUtils'

import './galery.css'

const Galery = () => {
  const galery = getGalery('galery')
  const settings = {
    dots: false,
    arrows: false,
    infinite: true,
    autoplay: true,
    speed: 500,
    slidesToShow: 5,
    slidesToScroll: 1,
    initialSlide: 0,
    responsive: [
      {
        breakpoint: 1720,
        settings: {
          slidesToShow: 4,
          arrows: false,
        },
      },
      {
        breakpoint: 1290,
        settings: {
          slidesToShow: 3,
          arrows: false,
        },
      },
      {
        breakpoint: 860,
        settings: {
          slidesToShow: 2,
          arrows: false,
        },
      },
      {
        breakpoint: 430,
        settings: {
          arrows: false,
          slidesToShow: 1,
        },
      },
    ],
  }

  return (
    <section data-aos='fade-up' className='galery'>
      <Slider {...settings}>
        {galery.map(image => (
          <div key={image.id} className='content_product'>
            <img src={image.img_src} alt={image.img_alt} />
          </div>
        ))}
      </Slider>
    </section>
  )
}

export default Galery

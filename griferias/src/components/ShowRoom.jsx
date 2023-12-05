import { useContext } from 'react'
import { StoreContext } from '../context/store'
import './showroom.css'

const ShowRoom = () => {
  const { setMessage, isPromo } = useContext(StoreContext)

  const scrollToTop = msg => {
    window.scroll({
      top: 350,
      left: 0,
      behavior: 'smooth',
    })
    setMessage(msg)
  }

  const msg = isPromo
    ? 'Quiero coordinar una visita al shoowroom por los descuentos de esta promoción en curso...'
    : 'Necesito coordinar una visita al shoowroom...'

  return (
    <section className='showroom container-fluid'>
      <div data-aos='fade-up' className='row'>
        <div className='content_showroom col-lg-10'>
          <div className='row'>
            <div className='col-lg-9 offset-lg-3 grouped'>
              <img
                className='img-fluid img_showroom'
                src='./img/griferia.jpg'
                alt='griferia cierre ceramico instalada'
              />
              <div className='data_showroom'>
                <img
                  className='img-fluid'
                  src='./img/icono-showroom.png'
                  alt='icono showroom griferias'
                />
                <p>Visita nuestro Showroom</p>
                <button onClick={() => scrollToTop(msg)} className='btn'>
                  SOLICITÁ UNA VISITA
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  )
}

export default ShowRoom

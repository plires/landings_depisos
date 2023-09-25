import { useContext } from 'react'
import { StoreContext } from '../context/store'
import './last-cta.css'

const LastCta = () => {
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
    ? 'Quiero consultar por los descuentos de esta promoción en curso...'
    : 'Necesito hacer una consulta...'

  return (
    <section className='last_cta container'>
      <div className='row'>
        <div className='content_cta col-lg-6 offset-lg-3'>
          <h2>¡Última oportunidad!</h2>
          {isPromo && (
            <p className='promo cta_promo'>STOCK LIMITADO HASTA SEPTIEMBRE</p>
          )}
          <button onClick={() => scrollToTop(msg)} className='btn'>
            CONTÁCTANOS
          </button>
        </div>
      </div>
    </section>
  )
}
export default LastCta

import { useContext } from 'react'
import { StoreContext } from '../context/store'

const Product = ({ product }) => {
  const { setMessage, isPromo } = useContext(StoreContext)

  const scrollToTop = (line, color) => {
    const msg = isPromo
      ? `Quiero consultar por el producto de la ${line}, color: ${color}, que se encuentra en promoción...`
      : `Quiero consultar por el producto de la ${line}, color: ${color}`

    window.scroll({
      top: 350,
      left: 0,
      behavior: 'smooth',
    })
    setMessage(msg)
  }

  return (
    <div className='content_product'>
      <img
        className='img-fluid'
        src={`./img/tetovinilico/${product.img_src}`}
        alt={product.img_alt}
      />

      <div className='inferior'>
        <p className='description_product'>
          {product.brand} - {product.line}. Color: {product.color} -{' '}
          {product.measures}
        </p>
        <button
          className='btn'
          onClick={() => scrollToTop(product.line, product.color)}
        >
          Consultar
        </button>
      </div>
    </div>
  )
}
export default Product

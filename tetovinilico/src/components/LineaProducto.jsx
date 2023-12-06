import './linea-producto.css'

const LineaProducto = ({ marca }) => {
  return (
    <div data-aos='fade-up' className='content_lineas'>
      <div className='marca'>
        <img
          className='img-fluid'
          src={marca.logo_img_src}
          alt={marca.logo_img_alt}
        />
      </div>
      <img
        className='img-fluid img_marca'
        src={marca.product_img_src}
        alt={marca.product_img_alt}
      />
    </div>
  )
}

export default LineaProducto

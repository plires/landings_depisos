import { getVentajas } from './../utils/dataUtils'

import './ventajas.css'

const Ventajas = () => {
  const ventajas = getVentajas('ventajas')
  return (
    <section className='container ventajas'>
      <div data-aos='fade-up' className='row'>
        <div className='col-md-8 offset-md-2'>
          <h2>Grandes Ventajas</h2>
          <p className='parrafo_destacado'>
            Pensado para ofrecerte un producto innovador y con grandes ventajas,
            el revestimiento para techos Teto Vinílico es la solución perfecta
            para renovar cualquier espacio.
          </p>
        </div>
      </div>

      <div data-aos='fade-up' className='row data'>
        {ventajas.map(ventaja => (
          <div key={ventaja.id} className='col-sm-6 col-md-3'>
            <div className='content'>
              <img
                className='img-fluid'
                src={`./img/tetovinilico/${ventaja.img_src}`}
                alt={ventaja.img_alt}
              />
              <h3 dangerouslySetInnerHTML={{ __html: ventaja.title }}></h3>
              <p>{ventaja.description}</p>
            </div>
          </div>
        ))}
      </div>
    </section>
  )
}

export default Ventajas

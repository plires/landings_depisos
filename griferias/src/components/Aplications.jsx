import { getAplications } from './../utils/dataUtils'
import Icon from './Icon'
import './aplications.css'

const Aplications = () => {
  const aplications = getAplications('aplications')

  return (
    <section className='container-fluid aplicaciones'>
      <div className='container'>
        <div className='row'>
          <div className='col-sm-12 col-md-10 offset-md-1 col-lg-8 offset-lg-2'>
            <div className='row'>
              {aplications.map(aplication => (
                <div key={aplication.id} className='col-4'>
                  <Icon aplication={aplication} />
                </div>
              ))}
            </div>
          </div>
        </div>
        <div className='row'>
          <div className='col-md-8 offset-md-2 content_description'>
            <p>
              Estos elegantes <span>accesorios</span> son versátiles y se
              adaptan a una amplia gama de entornos, desde{' '}
              <span>baños y cocinas modernas</span> hasta espacios más
              tradicionales.
            </p>
          </div>
        </div>
      </div>
    </section>
  )
}
export default Aplications

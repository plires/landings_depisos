import { getSlidesSecundarioSuperior } from './../utils/dataUtils'

const SlideSecundarioSuperior = ({ interval }) => {
  const slidesSecundarioSuperior = getSlidesSecundarioSuperior(
    'slidesSecundarioSuperior',
  )
  return (
    <div
      id='carouselPrincipal'
      className='carousel slide carousel-fade'
      data-bs-ride='carousel'
      data-bs-interval={interval}
    >
      <div className='carousel-inner'>
        {slidesSecundarioSuperior.map(item => (
          <div
            key={item.id}
            className={`carousel-item ${item.isActive ? 'active' : ''}`}
          >
            <img
              src={item.img_src}
              className='d-block w-100'
              alt={item.img_alt}
            />
          </div>
        ))}
      </div>
    </div>
  )
}
export default SlideSecundarioSuperior

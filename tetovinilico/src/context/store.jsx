import { createContext, useState } from 'react'

export const StoreContext = createContext()

const StoreProvider = ({ children }) => {
  const [isPromo, setIsPromo] = useState(
    import.meta.env.VITE_IS_PROMO === 'true',
  )
  const [message, setMessage] = useState('')
  return (
    <StoreContext.Provider
      value={{
        isPromo,
        setIsPromo,
        message,
        setMessage,
      }}
    >
      {children}
    </StoreContext.Provider>
  )
}

export default StoreProvider

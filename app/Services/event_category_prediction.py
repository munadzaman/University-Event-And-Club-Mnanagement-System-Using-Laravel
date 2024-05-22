#!/usr/bin/env python
# coding: utf-8

# In[2]:


import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.svm import SVC
import re

# Load and preprocess the dataset
data = pd.read_csv('combined_dataset.csv')

# Filter out categories not in the provided list
allowed_categories = ['Art & Cultural', 'Communication & Entrepreneurship', 'Leadership & Intellectual',
                      'Spiritual Values & Civilizational', 'Sports & Recreational', 'Exempted',
                      'Ethics & Humanity', 'Leadership & Communication', 'Sports & Recreation',
                      'Arts & Culture', 'Intellectuality', 'Entrepreneurship']

data_filtered = data[data['Category'].isin(allowed_categories)]

# Proceed with the dataset
X = data_filtered['Event']
y = data_filtered['Category']

# Split the data into training and testing sets with stratified splitting
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42, stratify=y)

# Convert text data into numerical features using TF-IDF vectorization
tfidf_vectorizer = TfidfVectorizer(max_features=1000)  # You can adjust max_features as needed
X_train_tfidf = tfidf_vectorizer.fit_transform(X_train)
X_test_tfidf = tfidf_vectorizer.transform(X_test)

# Train the SVM model with probability=True
model = SVC(kernel='linear', probability=True)
model.fit(X_train_tfidf, y_train)

# Define a function to preprocess text data
def preprocess_text(text):
    # Remove URLs
    text = re.sub(r'http\S+', '', text)
    # Remove emojis and other non-ASCII characters
    text = text.encode('ascii', 'ignore').decode('ascii')
    return text

# Function to preprocess the input data and make predictions
def predict_event_category(input_text):
    if not input_text:
        return 'Uncategorized'
    
    preprocessed_text = preprocess_text(input_text)
    # Take only the first 20 words
    preprocessed_text = ' '.join(preprocessed_text.split()[:20])
    test_data_tfidf = tfidf_vectorizer.transform([preprocessed_text])
    prediction = model.predict(test_data_tfidf)
    
    # Check prediction accuracy
    prediction_proba = model.predict_proba(test_data_tfidf)
    max_proba = max(prediction_proba[0])
    if max_proba < 0.2:
        return 'Uncategorized'
    
    return prediction[0]

# Request user to provide event description
user_input = input("Please provide the event description: ")

# Make predictions
predicted_category = predict_event_category(user_input)
print("Predicted category:", predicted_category)






